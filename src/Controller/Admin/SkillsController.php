<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/panel', name: 'admin_panel_')]
class SkillsController extends AbstractController
{
    #[Route('/skills', name: 'skills')]
    public function index(SkillRepository $skillRepository, Request $request): Response
    {
        $skills = [];
        
        // Pagination
        $countPerPage = 8;
        $countPages = 0;
        $totalSkillsFound = 0;
        $currentPage = $request->query->getInt('page', 1);
        
        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $skills = $skillRepository->searchByEmailOrLastNameOrFirstName($searchTerm, $currentPage, $countPerPage);
            $totalSkillsFound = count($skills);
            $countPages = ceil($totalSkillsFound / $countPerPage);
            $activatePaginate = true;
        }
        else {
            $countSkills = $skillRepository->count([]);
            $countPages = ceil($countSkills / $countPerPage);
            $skills = $skillRepository->paginate('p', $currentPage, $countPerPage);
        }
    
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }

        $skills = $skillRepository->findAll();


        return $this->render('admin/skills/index.html.twig', [
            'skills' => $skills,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }

    #[Route('/skill/edit/{id}', name: 'skill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SkillType::class, $skill, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'La compétence a été mise à jour avec succès.');

            return $this->redirectToRoute('admin_panel_skills');
        }

        return $this->render('admin/skills/edit.html.twig', [
            'skill' => $skill,
            'edit_form' => $form->createView(),
        ]);
    }

    #[Route('/skill/delete/{id}', name: 'skill_delete', methods: ['POST'])]
    public function delete(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
            $entityManager->remove($skill);
            $entityManager->flush();

            $this->addFlash('success', 'La compétence a été supprimée avec succès.');
        } else {
            $this->addFlash('error', 'Jeton CSRF invalide, impossible de supprimer la compétence.');
        }

        return $this->redirectToRoute('admin_panel_skills');
    }
}

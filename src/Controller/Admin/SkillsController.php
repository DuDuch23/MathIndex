<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

#[Route(path: '/panel', name: 'admin_panel_')]
class SkillsController extends AbstractController
{
    #[Route('/skills', name: 'skills')]
    public function index(SkillRepository $skillRepository, Request $request): Response
    {
        // Déclaration du tableau accueillant la/les compétence(s) trouvée(s)
        $skills = [];

        // Pagination
        $countPerPage = 4;
        $countPages = 0;
        $totalSkillsFound = 0;
        $currentPage = $request->query->getInt('page', 1);

        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $skills = $skillRepository->searchSkillByName($searchTerm, $currentPage, $countPerPage);
            $totalSkillsFound = count($skills);

            if($totalSkillsFound > 0){
                $countPages = ceil($totalSkillsFound / $countPerPage);
                $totalSkillsFound = count($skills);
                $activatePaginate = true;
            }
            elseif (empty($skills)) {
                $noSkillFound = $searchTerm . " n'existe pas";
                $countSkills = $skillRepository->count([]);
                $countPages = ceil($countSkills / $countPerPage);
                $skills = $skillRepository->paginate('p', $currentPage, $countPerPage);
                return $this->render('admin/skills/index.html.twig', [
                    'skills' => $skills, // Toutes les compétences affichées
                    'countPages' => $countPages,
                    'currentPage' => $currentPage,
                    'noSkillFound' => $noSkillFound,
                ]);
            }
        }
        else{
            $countSkills = $skillRepository->count([]);
            $countPages = ceil($countSkills / $countPerPage);
            $skills = $skillRepository->paginate('p', $currentPage, $countPerPage);
        }
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
        
        return $this->render('admin/skills/index.html.twig', [
            'skills' => $skills, // Toutes les compétences affichées
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
        
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
    }

    #[Route(path: '/skills/add', name: 'skills_add')]
    public function addClassroom(Request $request, EntityManagerInterface $entityManager): Response
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $entityManager->persist($skill);
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_skill_edit', [
                    'id' => $skill->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('admin/skills/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route(path: '/skill/edit/{id}', name: 'skill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SkillType::class, $skill, [
            'method' => 'POST',
        ]);

        try{
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();
    
                return $this->redirectToRoute('admin_panel_skill_edit', [
                    'id' => $skill->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }catch(Exception $e){
            echo $e;
        }

        return $this->render('admin/skills/edit.html.twig', [
            'form' => $form->createView(),
            'skill' => $skill,
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

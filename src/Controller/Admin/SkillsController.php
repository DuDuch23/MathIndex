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

#[Route('/panel', name: 'admin_panel_')]
class SkillsController extends AbstractController
{
    #[Route('/skills', name: 'skills')]
    public function index(SkillRepository $skillRepository): Response
    {
        $skills = $skillRepository->findAll();

        return $this->render('admin/skills/index.html.twig', [
            'skills' => $skills,
        ]);
    }

    #[Route('/skill/edit/{id}', name: 'skill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SkillType::class, $skill);
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

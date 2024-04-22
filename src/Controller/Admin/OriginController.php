<?php

namespace App\Controller\Admin;

use App\Entity\Origin;
use App\Form\OriginType;
use App\Repository\OriginRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panel', name: 'admin_panel_')]
class OriginController extends AbstractController
{
    #[Route('/origin', name: 'origin')]
    public function index(OriginRepository $originRepository): Response
    {
        $origins = $originRepository->findAll();
        return $this->render('admin/origin/index.html.twig', [
            'origins' => $origins,
        ]);
    }

    #[Route('origin/edit/{id}', name: 'origin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Origin $origin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OriginType::class, $origin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Origin updated successfully.');
            return $this->redirectToRoute('admin_panel_origin');
        }

        return $this->render('admin/origin/edit.html.twig', [
            'origin' => $origin,
            'edit_form' => $form->createView(),
        ]);
    }

    #[Route('origin/delete/{id}', name: 'origin_delete', methods: ['POST'])]
    public function delete(Request $request, Origin $origin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$origin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($origin);
            $entityManager->flush();
            $this->addFlash('success', 'Origin deleted successfully.');
        } else {
            $this->addFlash('error', 'Invalid CSRF token, unable to delete origin.');
        }

        return $this->redirectToRoute('admin_panel_origin');
    }
}

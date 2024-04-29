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
    public function index(OriginRepository $originRepository, Request $request): Response
    {
        $origins = [];
        
        // Pagination
        $countPerPage = 8;
        $countPages = 0;
        $totalOriginsFound = 0;
        $currentPage = $request->query->getInt('page', 1);
        
        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $origins = $originRepository->searchByEmailOrLastNameOrFirstName($searchTerm, $currentPage, $countPerPage);
            $totalOriginsFound = count($origins);
            $countPages = ceil($totalOriginsFound / $countPerPage);
            $activatePaginate = true;
        }
        else {
            $countOrigins = $originRepository->count([]);
            $countPages = ceil($countOrigins / $countPerPage);
            $origins = $originRepository->paginate('p', $currentPage, $countPerPage);
        }
    
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }

        $origins = $originRepository->findAll();
        return $this->render('admin/origin/index.html.twig', [
            'origins' => $origins,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }

    #[Route(path: '/add', name: 'origin_add')]
    public function addOrigin(Request $request, EntityManagerInterface $entityManager): Response
    {
        $origin = new Origin();
        $form = $this->createForm(OriginType::class, $origin);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $entityManager->persist($origin);
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_origin', [
                    'id' => $origin->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('admin/origin/add_origin.html.twig', [
            'form' => $form,
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
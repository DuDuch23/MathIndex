<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Origin;
use App\Form\OriginType;
use App\Repository\OriginRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

#[Route(path: '/panel', name: 'admin_panel_')]
class OriginController extends AbstractController
{
    #[Route('/origin', name: 'origin')]
    public function index(OriginRepository $originRepository, Request $request): Response
    {
        // Déclaration du tableau accueillant l'/les origine(s) trouvée(s)
        $origins = [];

        // Pagination
        $countPerPage = 4;
        $countPages = 0;
        $totalOriginsFound = 0;
        $currentPage = $request->query->getInt('page', 1);

        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $origins = $originRepository->searchOriginByName($searchTerm, $currentPage, $countPerPage);
            $totalOriginsFound = count($origins);

            if($totalOriginsFound > 0){
                $countPages = ceil($totalOriginsFound / $countPerPage);
                $totalOriginsFound = count($origins);
                $activatePaginate = true;
            }
            elseif (empty($origins)) {
                $noOriginFound = $searchTerm . " n'existe pas";
                $countOrigins = $originRepository->count([]);
                $countPages = ceil($countOrigins / $countPerPage);
                $origins = $originRepository->paginate('p', $currentPage, $countPerPage);
                return $this->render('admin/origin/index.html.twig', [
                    'origins' => $origins, // Toutes les origines affichées
                    'countPages' => $countPages,
                    'currentPage' => $currentPage,
                    'noOriginFound' => $noOriginFound,
                ]);
            }
        }
        else{
            $countOrigins = $originRepository->count([]);
            $countPages = ceil($countOrigins / $countPerPage);
            $origins = $originRepository->paginate('p', $currentPage, $countPerPage);
        }
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
        
        return $this->render('admin/origin/index.html.twig', [
            'origins' => $origins, // Toutes les origines affichées
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
        
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
    }

    #[Route(path: '/origin/add', name: 'origin_add')]
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

                return $this->redirectToRoute('admin_panel_origin_edit', [
                    'id' => $origin->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('admin/origin/add.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route(path: '/origin/edit/{id}', name: 'origin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Origin $origin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OriginType::class, $origin, [
            'method' => 'POST',
        ]);

        try{
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_origin_edit', [
                    'id' => $origin->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }catch(Exception $e){
            echo $e;
        }

        return $this->render('admin/origin/edit.html.twig', [
            'form' => $form->createView(),
            'origin' => $origin,
        ]);
    }

    #[Route(path: '/origin/delete/{id}', name: 'origin_delete', methods: ['POST'])]
    public function delete(Request $request, Origin $origin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $origin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($origin);
            $entityManager->flush();

            $this->addFlash('success', 'La classe a été supprimée avec succès.');
        } else {
            $this->addFlash('error', 'Jeton CSRF invalide, impossible de supprimer la classe.');
        }

        return $this->redirectToRoute('admin_panel_origin');
    }
}
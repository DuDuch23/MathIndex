<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Thematic;
use App\Form\ThematicType;
use App\Repository\ThematicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

#[Route(path: '/panel', name: 'admin_panel_')]
class ThematicController extends AbstractController
{
    #[Route('/thematic', name: 'thematic')]
    public function index(ThematicRepository $thematicRepository, Request $request): Response
    {
        // Déclaration du tableau accueillant la/les thématique(s) trouvée(s)
        $thematic = [];

        // Pagination
        $countPerPage = 4;
        $countPages = 0;
        $totalThematicFound = 0;
        $currentPage = $request->query->getInt('page', 1);

        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $thematic = $thematicRepository->searchThematicByName($searchTerm, $currentPage, $countPerPage);
            $totalThematicFound = count($thematic);

            if($totalThematicFound > 0){
                $countPages = ceil($totalThematicFound / $countPerPage);
                $totalThematicFound = count($thematic);
                $activatePaginate = true;
            }
            elseif (empty($thematic)) {
                $noThematicFound = $searchTerm . " n'existe pas";
                $countThematics = $thematicRepository->count([]);
                $countPages = ceil($countThematics / $countPerPage);
                $thematic = $thematicRepository->paginate('p', $currentPage, $countPerPage);
                return $this->render('admin/thematic/index.html.twig', [
                    'thematic' => $thematic, // Toutes les thématiques affichées
                    'countPages' => $countPages,
                    'currentPage' => $currentPage,
                    'noThematicFound' => $noThematicFound,
                ]);
            }
        }
        else{
            $countThematics = $thematicRepository->count([]);
            $countPages = ceil($countThematics / $countPerPage);
            $thematic = $thematicRepository->paginate('p', $currentPage, $countPerPage);
        }
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
        
        return $this->render('admin/thematic/index.html.twig', [
            'thematic' => $thematic, // Toutes les thématiques affichées
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
        
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
    }

    #[Route(path: '/thematic/add', name: 'thematic_add')]
    public function addOrigin(Request $request, EntityManagerInterface $entityManager): Response
    {
        $thematic = new Thematic();
        $form = $this->createForm(ThematicType::class, $thematic);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $entityManager->persist($thematic);
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_thematic_edit', [
                    'id' => $thematic->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('admin/thematic/add.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route(path: '/thematic/edit/{id}', name: 'thematic_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Thematic $thematic, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ThematicType::class, $thematic, [
            'method' => 'POST',
        ]);

        try{
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_thematic_edit', [
                    'id' => $thematic->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }catch(Exception $e){
            echo $e;
        }

        return $this->render('admin/thematic/edit.html.twig', [
            'form' => $form->createView(),
            'thematic' => $thematic,
        ]);
    }

    #[Route(path: '/thematic/delete/{id}', name: 'thematic_delete', methods: ['POST'])]
    public function delete(Request $request, Thematic $thematic, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $thematic->getId(), $request->request->get('_token'))) {
            $entityManager->remove($thematic);
            $entityManager->flush();

            $this->addFlash('success', 'La thematic a été supprimée avec succès.');
        } else {
            $this->addFlash('error', 'Jeton CSRF invalide, impossible de supprimer la classe.');
        }

        return $this->redirectToRoute('admin_panel_thematic');
    }
}
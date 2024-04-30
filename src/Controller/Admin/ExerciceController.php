<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Exercise;
use App\Form\SoumettreType;
use App\Repository\ExerciseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

#[Route(path: '/panel', name: 'admin_panel_')]
class ExerciceController extends AbstractController
{
    #[Route(path: '/exercice', name: 'exercice')]
    public function index(ExerciseRepository $exerciceRepository, Request $request): Response
    {
        // Déclaration du tableau accueillant le/les exercice(s) trouvé(s)
        $exercices = [];

        // Pagination
        $countPerPage = 4;
        $countPages = 0;
        $totalExercicesFound = 0;
        $currentPage = $request->query->getInt('page', 1);

        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $exercices = $exerciceRepository->searchExerciseByName($searchTerm, $currentPage, $countPerPage);
            $totalExercicesFound = count($exercices);

            if($totalExercicesFound > 0){
                $countPages = ceil($totalExercicesFound / $countPerPage);
                $totalExercicesFound = count($exercices);
                $activatePaginate = true;
            }
            elseif (empty($exercices)) {
                $noExerciceFound = $searchTerm . " n'existe pas";
                $countExercices = $exerciceRepository->count([]);
                $countPages = ceil($countExercices / $countPerPage);
                $exercices = $exerciceRepository->paginate('p', $currentPage, $countPerPage);
                return $this->render('admin/exercice/index.html.twig', [
                    'exercices' => $exercices, // Tous les exercices affichés
                    'countPages' => $countPages,
                    'currentPage' => $currentPage,
                    'noExerciceFound' => $noExerciceFound,
                ]);
            }
        }
        else{
            $countExercices = $exerciceRepository->count([]);
            $countPages = ceil($countExercices / $countPerPage);
            $exercices = $exerciceRepository->paginate('p', $currentPage, $countPerPage);
        }
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
        
        return $this->render('admin/exercice/index.html.twig', [
            'exercices' => $exercices, // Toutes les matières affichées
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
        
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
    }

    #[Route(path: '/exercice/add', name: 'exercice_add')]
    public function addExercice(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exercice = new Exercise();
        $form = $this->createForm(SoumettreType::class, $exercice);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $entityManager->persist($exercice);
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_exercice_edit', [
                    'id' => $exercice->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('admin/exercice/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route(path: '/exercice/edit/{id}', name: 'exercice_edit', methods: ['GET', 'POST'])]
    public function editCourse(Request $request, Exercise $exercice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SoumettreType::class, $exercice, [
            'method' => 'POST',
        ]);
        
        try{
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager->flush();
    
                return $this->redirectToRoute('admin_panel_exercice_edit', [
                    'id' => $exercice->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }catch(Exception $e){
            echo $e;
        }

        return $this->render('admin/exercice/edit.html.twig', [
            'form' => $form->createView(),
            'exercice' => $exercice,
        ]);
    }

    #[Route(path: '/exercice/delete/{id}', name: 'exercice_delete', methods: ['POST'])]
    public function delete(Request $request, Exercise $exercice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $exercice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($exercice);
            $entityManager->flush();

            $this->addFlash('success', 'La classe a été supprimée avec succès.');
        } else {
            $this->addFlash('error', 'Jeton CSRF invalide, impossible de supprimer l\'exercice.');
        }

        return $this->redirectToRoute('admin_panel_exercice');
    }
}
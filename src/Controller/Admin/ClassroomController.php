<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

#[Route(path: '/panel', name: 'admin_panel_')]
class ClassroomController extends AbstractController
{
    #[Route(path:'/classroom', name: 'classroom')]
    public function index(ClassroomRepository $classroomRepository, Request $request): Response
    {
        // Déclaration du tableau accueillant la/les classe(s) trouvée(s)
        $classrooms = [];

        // Pagination
        $countPerPage = 8;
        $countPages = 0;
        $totalClassroomsFound = 0;
        $currentPage = $request->query->getInt('page', 1);

        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $classrooms = $classroomRepository->searchClassroom($searchTerm, $currentPage, $countPerPage);
            $totalClassroomsFound = count($classrooms);

            if($totalClassroomsFound > 0){
                $countPages = ceil($totalClassroomsFound / $countPerPage);
                $totalClassroomsFound = count($classrooms);
                $activatePaginate = true;
            }
            elseif (empty($classrooms)) {
                $noClassroomFound = $searchTerm . " n'existe pas";
                $countUsers = $classroomRepository->count([]);
                $countPages = ceil($countUsers / $countPerPage);
                $classrooms = $classroomRepository->paginate('p', $currentPage, $countPerPage);
                return $this->render('admin/classroom/index.html.twig', [
                    'classrooms' => $classrooms, // Toutes les classes affichées
                    'countPages' => $countPages,
                    'currentPage' => $currentPage,
                    'noClassroomFound' => $noClassroomFound,
                ]);
            }
        }
        else{
            $countClassrooms = $classroomRepository->count([]);
            $countPages = ceil($countClassrooms / $countPerPage);
            $classrooms = $classroomRepository->paginate('p', $currentPage, $countPerPage);
        }
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
        
        return $this->render('admin/classroom/index.html.twig', [
            'classrooms' => $classrooms, // Toutes les classes affichées
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
        
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
    }

    #[Route(path: '/classroom/add', name: 'classroom_add')]
    public function addClassroom(Request $request, EntityManagerInterface $entityManager): Response
    {
        $classroom = new classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $entityManager->persist($classroom);
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_classroom', [
                    'id' => $classroom->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('admin/classroom/add.html.twig', [
            'form' => $form,
        ]);
    }
    
    #[Route(path: '/classroom/edit/{id}', name: 'classroom_edit', methods: ['GET', 'POST'])]
    public function editClassroom(Request $request, Classroom $classroom, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClassroomType::class, $classroom, [
            'method' => 'POST',
        ]);

        try{
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_classroom_edit', [
                    'id' => $classroom->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }catch(Exception $e){
            echo $e;
        }

        return $this->render('admin/classroom/edit.html.twig', [
            'form' => $form,
            'classroom' => $classroom,
        ]);
    }

    #[Route(path: '/classroom/delete/{id}', name: 'classroom_delete', methods: ['POST'])]
    public function delete(Request $request, Classroom $classroom, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classroom->getId(), $request->request->get('_token'))) {
            $entityManager->remove($classroom);
            $entityManager->flush();

            $this->addFlash('success', 'La classe a été supprimée avec succès.');
        } else {
            $this->addFlash('error', 'Jeton CSRF invalide, impossible de supprimer la classe.');
        }

        return $this->redirectToRoute('admin_panel_classroom');
    }
}

<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Classroom;
use App\Form\ClassroomType;
use Doctrine\ORM\EntityManagerInterface;



#[Route(path: '/panel', name: 'admin_panel_')]
class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'classroom')]
    public function index(ClassroomRepository $classroomRepository, Request $request): Response
    {
        $classrooms = [];
        $countPerPage = 8;
        $countPages = 0;
        $currentPage = $request->query->getInt('page', 1);

        $classrooms = $classroomRepository->findAll();

        return $this->render('admin/classroom/index.html.twig', [
            'classrooms' => $classrooms,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);

        
            if($currentPage > $countPages || $currentPage <= 0)
            {
                throw $this->createNotFoundException();
            }
    }

    #[Route(path: '/classroom/edit/{id}', name: 'classroom_edit')]
    public function editClassroom(Request $request, Classroom $classroom, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClassroomType::class, $classroom, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();

            return $this->redirectToRoute('admin_panel_classroom', [
                'id' => $classroom->getId(),
            ]);
        }
        else{
            $this->addFlash('error', 'Le formulaire contient des erreurs');
        }

        return $this->render('admin/classroom/edit.html.twig', [
            'form' => $form,
            'classroom' => $classroom,
        ]);
    }

    #[Route('/classroom/delete/{id}', name: 'classroom_delete', methods: ['POST'])]
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
}

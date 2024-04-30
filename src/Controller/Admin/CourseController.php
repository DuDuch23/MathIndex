<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Course;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

#[Route(path: '/panel', name: 'admin_panel_')]
class CourseController extends AbstractController
{
    #[Route(path: '/course', name: 'course')]
    public function index(CourseRepository $courseRepository, Request $request): Response
    {
        // Déclaration du tableau accueillant la/les matière(s) trouvée(s)
        $courses = [];

        // Pagination
        $countPerPage = 4;
        $countPages = 0;
        $totalCoursesFound = 0;
        $currentPage = $request->query->getInt('page', 1);

        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $courses = $courseRepository->searchCourse($searchTerm, $currentPage, $countPerPage);
            $totalCoursesFound = count($courses);

            if($totalCoursesFound > 0){
                $countPages = ceil($totalCoursesFound / $countPerPage);
                $totalCoursesFound = count($courses);
                $activatePaginate = true;
            }
            elseif (empty($courses)) {
                $noCourseFound = $searchTerm . " n'existe pas";
                $countCourses = $courseRepository->count([]);
                $countPages = ceil($countCourses / $countPerPage);
                $courses = $courseRepository->paginate('p', $currentPage, $countPerPage);
                return $this->render('admin/course/index.html.twig', [
                    'courses' => $courses, // Toutes les matières affichées
                    'countPages' => $countPages,
                    'currentPage' => $currentPage,
                    'noCourseFound' => $noCourseFound,
                ]);
            }
        }
        else{
            $countCourses = $courseRepository->count([]);
            $countPages = ceil($countCourses / $countPerPage);
            $courses = $courseRepository->paginate('p', $currentPage, $countPerPage);
        }
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
        
        return $this->render('admin/course/index.html.twig', [
            'courses' => $courses, // Toutes les matières affichées
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
        
        
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }
    }

    #[Route(path: '/course/add', name: 'course_add')]
    public function addClassroom(Request $request, EntityManagerInterface $entityManager): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $entityManager->persist($course);
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_course_edit', [
                    'id' => $course->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('admin/course/add.html.twig', [
            'form' => $form,
        ]);
    }
    
    #[Route(path: '/course/edit/{id}', name: 'course_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Course $course, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CourseType::class, $course, [
            'method' => 'POST',
        ]);
        
        try{
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();
    
                return $this->redirectToRoute('admin_panel_course_edit', [
                    'id' => $course->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }catch(Exception $e){
            echo $e;
        }

        return $this->render('admin/course/edit.html.twig', [
            'form' => $form->createView(),
            'course' => $course,
        ]);
    }

    #[Route(path: '/course/delete/{id}', name: 'course_delete', methods: 'DELETE')]
    public function delete(Request $request, Course $course, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $token = $request->request->get('csrf_token');

        if (!$this->isCsrfTokenValid('delete-course', $token)) {
            throw $this->createAccessDeniedException();
        }

        try {
            $entityManager->remove($course);
            $entityManager->flush();
        } catch (Exception $e) {
            $logger->error($e->getMessage());
            $this->addFlash('error', 'Impossible de supprimer l\'utilisateur.');
        }

        return $this->redirectToRoute('admin_panel_course');
    }
}
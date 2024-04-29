<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CourseRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

#[Route(path: '/panel', name: 'admin_panel_')]
class CourseController extends AbstractController
{
    #[Route(path: '/course', name: 'course')]
    public function index(CourseRepository $courseRepository, Request $request): Response
    {
        $courses = $courseRepository->findAll();
        $countPerPage = 8;
        $countPages = 0;
        $totalUsersFound = 0;
        $currentPage = $request->query->getInt('page', 1);
        $activatePaginate = false;

        return $this->render('admin/course/index.html.twig', [
            'courses' => $courses,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }

    #[Route(path: '/delete/{id}', name: 'course_delete', methods: 'DELETE')]
    public function delete(Request $request, Course $course, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $token = $request->request->get('csrf_token');

        if (!$this->isCsrfTokenValid('delete-course', $token)) {
            throw $this->createAccessDeniedException();
        }

        try {
            $entityManager->remove($course);
            $entityManager->flush();
        } catch (\Exception $e) {
            $logger->error($e->getMessage());
            $this->addFlash('error', 'Impossible de supprimer l\'utilisateur.');
        }

        return $this->redirectToRoute('admin_panel_course');
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Le nom doit contenir {{ limit }} caractères au minimum.',
                        'maxMessage' => 'Le nom ne doit pas excéder {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn',
                ],
            ])
        ;
        ;
    }

}
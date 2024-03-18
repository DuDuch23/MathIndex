<?php

namespace App\Controller;

use App\Repository\ClassroomRepository;
use App\Repository\ExerciseRepository;
use App\Repository\ThematicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'recherche')]
    public function index(ExerciseRepository $exerciseRepository, ClassroomRepository $classroomRepository,
    ThematicRepository $thematicRepository ): Response
    {
        $classerooms = $classroomRepository->findAll();

        $thematics = $thematicRepository->findAll();

        $exercises = $exerciseRepository->findAll();

        return $this->render('recherche/index.html.twig', [
            'exercises' => $exercises,
            'classrooms' => $classerooms,
            'thematics' => $thematics
        ]);
    }
}

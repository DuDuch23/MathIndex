<?php

namespace App\Controller;

use App\Repository\ClassroomRepository;
use App\Repository\ExerciseRepository;
use App\Repository\ThematicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'recherche')]
    public function index(ExerciseRepository $exerciseRepository, ClassroomRepository $classroomRepository,
    ThematicRepository $thematicRepository, Request $request): Response
    {
        $classerooms = $classroomRepository->findAll();
        $thematics = $thematicRepository->findAll();

        $getClassroomName = $request->query->get('classroomName');
        $getThematicName = $request->query->get('thematicName');
        $getKeywords = $request->query->get('keywords');

        $foundExercices = [];

        if($getClassroomName && $getThematicName && $getKeywords)
        {
            $foundExercices = $exerciseRepository->searchExercice($getClassroomName, $getThematicName, $getKeywords);
        }

        $totalExerciseFound = count($foundExercices);

        //dd($foundExercices);

        return $this->render('recherche/index.html.twig', [
            'classrooms' => $classerooms,
            'thematics' => $thematics,
            'exercises' => $foundExercices,
            'totalExercise' => $totalExerciseFound,
        ]);
    }
}


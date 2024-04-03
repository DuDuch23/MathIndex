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


        switch (true) {
            case ($getClassroomName && $getThematicName && $getKeywords):
                $foundExercices = $exerciseRepository->searchExerciceByClassroomThematicKeywords($getClassroomName, $getThematicName, $getKeywords);
                break;
            case ($getClassroomName);
                $foundExercices = $exerciseRepository->searchExerciceByClassroom($getClassroomName);
                break;
            case ($getThematicName);
                $foundExercices = $exerciseRepository->searchExerciceByThematic($getThematicName);
                break;  
            case ($getKeywords);
                $foundExercices = $exerciseRepository->searchExerciceByKeywords($getKeywords);
                break;
            case ($getClassroomName && $getThematicName);
                $foundExercices = $exerciseRepository->searchExerciceByClassroomThematic($getClassroomName, $getThematicName);
                break;
            case ($getClassroomName && $getKeywords);
                $foundExercices = $exerciseRepository->searchExerciceByClassroomcKeywords($getClassroomName, $getKeywords);
                break;
            case ($getThematicName && $getKeywords);
                $foundExercices = $exerciseRepository->searchExerciceByThematicKeywords($getThematicName, $getKeywords);
                break;
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


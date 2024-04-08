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
    #[Route('/recherche', name: 'recherche', methods: ['GET'])]
    public function index(ExerciseRepository $exerciseRepository, ClassroomRepository $classroomRepository,
    ThematicRepository $thematicRepository, Request $request): Response
    {
        // Récupération de toutes les classes, thématiques 
        $classerooms = $classroomRepository->findAll();
        $thematics = $thematicRepository->findAll();

        // 
        $getClassroomName = $request->query->get('classroomName');
        $getThematicName = $request->query->get('thematicName');
        $getKeywords = $request->query->get('keywords');

        // Déclaration du tableau accueillant l'/les exercice(s) trouvé(s)
        $foundExercices = [];

        // Pagination
        $countPerPage = 10;
        $countPages = 0;
        $currentPage = $request->query->getInt('page', 1);

        // Nombres totales d'exercice(s)
        $totalExerciseFound = 0;

        // Déclaration de l'activation de la pagination
        $activatePaginate = false;

        switch (true) {
            
            case ($getClassroomName && $getThematicName && $getKeywords):
                $foundExercices = $exerciseRepository->searchExerciceByClassroomThematicKeywords($getClassroomName, $getThematicName, $getKeywords, $currentPage, $countPerPage);
                $totalExerciseFound = count($foundExercices);
                $countPages = ceil($totalExerciseFound / $countPerPage);
                $activatePaginate = true;
                break;
            case ($getClassroomName);
                $foundExercices = $exerciseRepository->searchExerciceByClassroom($getClassroomName, $currentPage, $countPerPage);
                $totalExerciseFound = count($foundExercices);
                $countPages = ceil($totalExerciseFound / $countPerPage);
                $activatePaginate = true;
                break;
            case ($getThematicName);
                $foundExercices = $exerciseRepository->searchExerciceByThematic($getThematicName, $currentPage, $countPerPage);
                $totalExerciseFound = count($foundExercices);
                $countPages = ceil($totalExerciseFound / $countPerPage);
                $activatePaginate = true;
                break;  
            case ($getKeywords);
                $foundExercices = $exerciseRepository->searchExerciceByKeywords($getKeywords, $currentPage, $countPerPage);
                $totalExerciseFound = count($foundExercices);
                $countPages = ceil($totalExerciseFound / $countPerPage);
                $activatePaginate = true;
                break;
            case ($getClassroomName && $getThematicName);
                $foundExercices = $exerciseRepository->searchExerciceByClassroomThematic($getClassroomName, $getThematicName, $currentPage, $countPerPage);
                $totalExerciseFound = count($foundExercices);
                $countPages = ceil($totalExerciseFound / $countPerPage);
                $activatePaginate = true;
                break;
            case ($getClassroomName && $getKeywords);
                $foundExercices = $exerciseRepository->searchExerciceByClassroomcKeywords($getClassroomName, $getKeywords, $currentPage, $countPerPage);
                $totalExerciseFound = count($foundExercices);
                $countPages = ceil($totalExerciseFound / $countPerPage);
                $activatePaginate = true;
                break;
            case ($getThematicName && $getKeywords);
                $foundExercices = $exerciseRepository->searchExerciceByThematicKeywords($getThematicName, $getKeywords, $currentPage, $countPerPage);
                $totalExerciseFound = count($foundExercices);
                $countPages = ceil($totalExerciseFound / $countPerPage);
                $activatePaginate = true;
                break;
        }

        if($activatePaginate)
        {
            if($currentPage > $countPages || $currentPage <= 0)
            {
                throw $this->createNotFoundException();
            }
        }
//dd($totalExerciseFound, $foundExercices);
//         $paginateExericses = $exerciseRepository->paginate('p', $currentPage, $countPerPage);
        
// dd($paginateExericses);
        

        return $this->render('recherche/index.html.twig', [
            'classrooms' => $classerooms,
            'thematics' => $thematics,
            'exercises' => $foundExercices,
            'totalExercise' => $totalExerciseFound,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }
}


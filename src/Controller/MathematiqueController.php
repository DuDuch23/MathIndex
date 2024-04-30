<?php

namespace App\Controller;

use App\Repository\ExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MathematiqueController extends AbstractController
{
    #[Route('/mathematique', name: 'mathematique')]
    public function index(ExerciseRepository $exerciseRepository, Request $request): Response
    {
        // Affichage des nouveautés, les 3 derniers exercices crées
        $nouveautes = $exerciseRepository->exerciseByThree();

        // Pagination
        $countPerPage = 5;
        $countPages = 0;
        $currentPage = $request->query->getInt('page', 1);
        $countExercises = $exerciseRepository->count([]);
        $countPages = ceil($countExercises / $countPerPage);
        $exercises = $exerciseRepository->paginate('p', $currentPage, $countPerPage); 

        return $this->render('mathematique/index.html.twig', [
            'exercises' => $exercises,
            'nouveautes' => $nouveautes,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }
}

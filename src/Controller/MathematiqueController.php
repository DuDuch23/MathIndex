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
        $exercises = $exerciseRepository->findAll();
        $nouveautes = $exerciseRepository->exerciseByThree();
        $countPerPage = 8;
        $countPages = 0;
        $totalUsersFound = 0;
        $currentPage = $request->query->getInt('page', 1);
        $activatePaginate = false;


        return $this->render('mathematique/index.html.twig', [
            'exercises' => $exercises,
            'nouveautes' => $nouveautes,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ExerciseRepository;

class ExercicesController extends AbstractController
{
    #[Route('/exercices', name: 'exercice')]
    public function index(ExerciseRepository $exerciseRepository): Response
    {

        $exercises = $exerciseRepository->findAll();

        return $this->render('exercices/index.html.twig', [
            'exercises' => $exercises,
        ]);
    }
}

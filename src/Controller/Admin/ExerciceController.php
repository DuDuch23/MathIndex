<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ExerciseRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: '/panel', name: 'admin_panel_')]
class ExerciceController extends AbstractController
{
    #[Route(path: '/exercice', name: 'exercice')]
    public function index(ExerciseRepository $exerciseRepository, Request $request): Response
    {
        $exercises = $exerciseRepository->findAll();
        $nouveautes = $exerciseRepository->exerciseByThree();
        $countPerPage = 8;
        $countPages = 0;
        $totalUsersFound = 0;
        $currentPage = $request->query->getInt('page', 1);
        $activatePaginate = false;

        return $this->render('admin/exercice/index.html.twig', [
            'exercises' => $exercises,
            'nouveautes' => $nouveautes,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }
}
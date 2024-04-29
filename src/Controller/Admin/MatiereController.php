<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ExerciseRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: '/panel', name: 'admin_panel_')]
class MatiereController extends AbstractController
{
    #[Route(path: '/matiere', name: 'matiere')]
    public function index(ExerciseRepository $MatiereRepository, Request $request): Response
    {
        $matiere = $matiereRepository->findAll();
        $nouveautes = $matiereRepository->matiereByThree();
        $countPerPage = 8;
        $countPages = 0;
        $totalUsersFound = 0;
        $currentPage = $request->query->getInt('page', 1);
        $activatePaginate = false;

        return $this->render('admin/matiere/index.html.twig', [
            'matieres' => $matieres,
            'nouveautes' => $nouveautes,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }
}
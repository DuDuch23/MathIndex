<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/panel', name: 'admin_panel_')]
class ExerciceController extends AbstractController
{
    #[Route(path: '/exercice', name: 'exercice')]
    public function index(): Response
    {
        return $this->render('admin/exercice/index.html.twig', [
        ]);
    }
}
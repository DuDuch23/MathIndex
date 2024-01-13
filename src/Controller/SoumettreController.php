<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SoumettreController extends AbstractController
{
    #[Route('/soumettre', name: 'soumettre')]
    public function index(): Response
    {
        return $this->render('soumettre/index.html.twig', [
            'controller_name' => 'SoumettreController',
        ]);
    }
}

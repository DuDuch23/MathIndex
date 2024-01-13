<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MathematiqueController extends AbstractController
{
    #[Route('/mathematique', name: 'mathematique')]
    public function index(): Response
    {
        return $this->render('mathematique/index.html.twig', [
            'controller_name' => 'MathematiqueController',
        ]);
    }
}

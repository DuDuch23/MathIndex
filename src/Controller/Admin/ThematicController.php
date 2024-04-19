<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/panel', name: 'admin_panel_')]
class ThematicController extends AbstractController
{
    #[Route(path: '/thematic', name: 'thematic')]
    public function index(): Response
    {
        return $this->render('admin/thematic/index.html.twig', [
        ]);
    }
}
<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/panel', name: 'admin_panel_')]
class OriginController extends AbstractController
{
    #[Route(path: '/origin', name: 'origin')]
    public function index(): Response
    {
        return $this->render('admin/origin/index.html.twig', [
        ]);
    }
}
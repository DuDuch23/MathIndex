<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/panel', name: 'admin_panel_')]
class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_admin_classroom')]
    public function index(): Response
    {
        return $this->render('admin/classroom/index.html.twig', [
            'controller_name' => 'AdminClassroomController',
        ]);
    }
}

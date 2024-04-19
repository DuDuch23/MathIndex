<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/panel', name: 'admin_panel_')]
class CourseController extends AbstractController
{
    #[Route(path: '/course', name: 'course')]
    public function index(): Response
    {
        return $this->render('admin/course/index.html.twig', [
        ]);
    }
}
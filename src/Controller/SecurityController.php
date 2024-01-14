<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Logout\LogoutUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    #[Route('/logout', name: 'logout')]
    public function logout(LogoutUrlGenerator $logoutUrlGenerator): RedirectResponse
    {
        $logoutUrl = $logoutUrlGenerator->getLogoutUrl();

        return new RedirectResponse($logoutUrl);
    }
}

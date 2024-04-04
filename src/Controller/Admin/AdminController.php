<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/panel', name: 'admin_panel_')]
class AdminController extends AbstractController
{
    #[Route(path: '/', name: 'user')]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $countUsers = $userRepository->count([]);
        $countPerPage = 8;

        $currentPage = $request->query->getInt('page',1);
        $countPages = ceil($countUsers / $countPerPage);

        // On vérifie que la page renseignée dans l'url est valide, si ce n'est pas le cas on génère une 404.
        if ($currentPage > $countPages || $currentPage <= 0) {
            throw $this->createNotFoundException();
        }
        
        $users = $userRepository->paginate('p', $currentPage, $countPerPage);

        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }

    #[Route(path: '/add', name: 'user_add')]
    public function addUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('admin_panel_user', [
                    'id' => $user->getId(),
                ]);
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('admin/add_user.html.twig');
    }

    #[Route(path: '/edit/{id}', name: 'user_edit')]
    public function editUser(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();

            return $this->redirectToRoute('admin_panel_user', [
                'id' => $user->getId(),
            ]);
        }
        else{
            $this->addFlash('error', 'Le formulaire contient des erreurs');
        }

        return $this->render('admin/edit_user.html.twig', [
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route(path: '/delete/{id}', name: 'user_delete', methods: 'DELETE')]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $token = $request->request->get('csrf_token');

        if (!$this->isCsrfTokenValid('delete-user', $token)) {
            throw $this->createAccessDeniedException();
        }

        try {
            $entityManager->remove($user);
            $entityManager->flush();
        } catch (\Exception $e) {
            $logger->error($e->getMessage());
            $this->addFlash('error', 'Impossible de supprimer l\'utilisateur.');
        }

        return $this->redirectToRoute('admin_panel_user');
    }
}

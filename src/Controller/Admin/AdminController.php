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
    #[Route(path: '/user', name: 'user', methods: ['GET'])]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        
        // Déclaration du tableau accueillant l'/les utilisateur(s) trouvé(s)
        $users = [];
        
        // Pagination
        $countPerPage = 8;
        $countPages = 0;
        $totalUsersFound = 0;
        $currentPage = $request->query->getInt('page', 1);
        
        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $users = $userRepository->searchByEmailOrLastNameOrFirstName($searchTerm, $currentPage, $countPerPage);
            $totalUsersFound = count($users);
            $countPages = ceil($totalUsersFound / $countPerPage);
            $activatePaginate = true;
        }
        else {
            $countUsers = $userRepository->count([]);
            $countPages = ceil($countUsers / $countPerPage);
            $users = $userRepository->paginate('p', $currentPage, $countPerPage);
        }
    
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }

        // dd($countPages, $currentPage, $countUsers);
        

        return $this->render('admin/user/index.html.twig', [
            'users' => $users, // Tout les utilisateurs affiché
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

        return $this->render('admin/user/add_user.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route(path: '/edit/{id}', name: 'user_edit', methods: ['GET', 'POST'])]
    public function editUser(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();

            return $this->redirectToRoute('admin_panel_user');
        }
        else{
            $this->addFlash('error', 'Le formulaire contient des erreurs');
        }


        return $this->render('admin/user/edit_user.html.twig', [
            'form' => $form->createView(),
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

    // #[Route(path: '/recherche', name: 'user_recherche', methods: ['GET'])]
    // public function recherche(UserRepository $userRepository, Request $request): Response
    // {

    //     // Déclaration du tableau accueillant l'/les exercice(s) trouvé(s)
    //     $foundUsers = [];


    // }
}

<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route(path: '/panel', name: 'admin_panel_')]
class AdminController extends AbstractController
{
    #[Route(path: '/user', name: 'user', methods: ['GET'])]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        // Déclaration du tableau accueillant l'/les utilisateur(s) trouvé(s)
        $users = [];
        
        // Pagination
        $countPerPage = 4;
        $countPages = 0;
        $totalUsersFound = 0;
        $currentPage = $request->query->getInt('page', 1);
        
        // Initialisation de la recherche
        $searchTerm = $request->query->get('searchTerm');

        if($searchTerm)
        {
            $users = $userRepository->searchByEmailOrLastNameOrFirstName($searchTerm, $currentPage, $countPerPage);
            $totalUsersFound = count($users);
            
            if($totalUsersFound > 0){
                $countPages = ceil($totalUsersFound / $countPerPage);
                $totalUsersFound = count($users);
                $activatePaginate = true;
            }
            elseif (empty($users)) {
                $noUserFound = $searchTerm . " n'existe pas";
                $countUsers = $userRepository->count([]);
                $countPages = ceil($countUsers / $countPerPage);
                $users = $userRepository->paginate('p', $currentPage, $countPerPage);
                return $this->render('admin/user/index.html.twig', [
                    'users' => $users, // Tout les utilisateurs affiché
                    'countPages' => $countPages,
                    'currentPage' => $currentPage,
                    'noUserFound' => $noUserFound,
                ]);
            }
        }
        else{
            $countUsers = $userRepository->count([]);
            $countPages = ceil($countUsers / $countPerPage);
            $users = $userRepository->paginate('p', $currentPage, $countPerPage);
        }
    
        if($currentPage > $countPages || $currentPage <= 0)
        {
            throw $this->createNotFoundException();
        }

        return $this->render('admin/user/index.html.twig', [
            'users' => $users, // Tout les utilisateurs affiché
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }

    #[Route(path: '/user/add', name: 'user_add')]
    public function addUser(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
                $user->setPassword($hashedPassword);
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

    #[Route(path: '/user/edit/{id}', name: 'user_edit', methods: ['GET', 'POST'])]
    public function editUser(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPassword): Response
    {
        $form = $this->createForm(UserType::class, $user, [
            'method' => 'POST',
        ]);
        
        try
        {
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $formData = $form->getData();
                $newRole = $formData->getRoles();
                $user->setRoles($newRole);
                
                $hasherPassword = $userPassword->hashPassword($user, $user->getPassword());
                $user->setPassword($hasherPassword);
                $entityManager->flush();
    
                return $this->redirectToRoute('admin_panel_user');
            }
            else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }catch(Exception $e){
            echo $e;
        }

        return $this->render('admin/user/edit_user.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route(path: '/user/delete/{id}', name: 'user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();

            $this->addFlash('success', 'L\'utilisateur a été supprimée avec succès.');
        } else {
            $this->addFlash('error', 'Jeton CSRF invalide, impossible de supprimer l\'utilisateur.');
        }

        return $this->redirectToRoute('admin_panel_user');
    }
}

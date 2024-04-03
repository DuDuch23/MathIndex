<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Exercise;
use App\Form\ExerciseType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ExerciseRepository;

class ExercicesController extends AbstractController
{
    #[Route('/exercices', name: 'exercice')]
    public function index(ExerciseRepository $exerciseRepository): Response
    {

        $exercises = $exerciseRepository->findAll();

        return $this->render('exercices/index.html.twig', [
            'exercises' => $exercises,
        ]);
    }

    #[Route('/exercices/modifier/{id}', name: 'modifier_exercice')]
    public function modifier(Request $request, Exercise $exercise, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire en utilisant le formulaire ExerciseType et l'entité Exercise
        $form = $this->createForm(ExerciseType::class, $exercise);

        // Traitement de la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement des modifications dans la base de données
            $entityManager->flush();

            // Redirection vers la page des exercices
            return $this->redirectToRoute('exercice');
        }

        // Affichage du formulaire de modification dans la vue
        return $this->render('exercices/modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/exercices/supprimer/{id}', name: 'supprimer_exercice')]
public function supprimer(Exercise $exercise, EntityManagerInterface $entityManager, Request $request): Response
{
    // Vérifiez si le token CSRF est valide ici

    if ($this->isCsrfTokenValid('delete'.$exercise->getId(), $request->request->get('_token'))) {
        $entityManager->remove($exercise);
        $entityManager->flush();

        $this->addFlash('success', 'L\'exercice a été supprimé.');
    } else {
        $this->addFlash('error', 'Token invalide, suppression annulée.');
    }

    return $this->redirectToRoute('exercice');
}
}

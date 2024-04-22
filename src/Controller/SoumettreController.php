<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SoumettreType;
use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Exception;

class SoumettreController extends AbstractController
{
    #[Route('/soumettre', name: 'soumettre')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exercise = new Exercise();

        $form = $this->createForm(SoumettreType::class, $exercise);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            try{
                $exercise->setCreatedById($this->getUser());
                $entityManager->persist($exercise);
                $entityManager->flush();

                $this->addFlash('Erreur', 'Exercice soumis');
            }
            catch(Exception $e){
                dd($e);
                return $this->redirectToRoute('soumettre', [
                    'erreur' => "Erreur lors de la création de l'exercice.",
                ]);
            }
        }


        return $this->render('soumettre/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

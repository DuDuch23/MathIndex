<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SoumettreType;
use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Psr\Log\LoggerInterface;
use Exception;

#[IsGranted('ROLE_TEACHER')]
class SoumettreController extends AbstractController
{
    #[Route('/soumettre', name: 'soumettre')]
    public function index(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
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

                $this->addFlash('success', 'Exercice soumis avec succès.');

                return $this->redirectToRoute('soumettre');
            }
            catch(Exception $e){
                $logger->error($e->getMessage(), ['exception' => $e]);
                $this->addFlash('error', "Erreur lors de la création de l'exercice.");
            }
        }


        return $this->render('soumettre/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DepenseController extends AbstractController
{
    #[Route('/depense/{date}', name: 'depense')]
    public function index($date): Response
    {
        return $this->render('depense/index.html.twig', [
            'date' => $date,
        ]);
    }

    #[Route('/depense/new/{date}', name: 'depense_new')]
    public function newDepense(Request $request, $date): Response
    {
        $depense = new Depense();
        $depense->setDate(new \DateTime($date));

        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depense);
            $entityManager->flush();

            return new JsonResponse(['status' => 'success', 'message' => 'Dépense enregistrée avec succès']);
        }

        return $this->render('depense_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

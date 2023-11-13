<?php

namespace App\Controller;

use App\Entity\Depense;
use App\Form\DepenseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DepenseFormController extends AbstractController
{
    #[Route('/depense/form/{date}', name: 'depense_form')]
    public function depenseForm($date): Response
    {
        $formUrl = $this->generateUrl('depense', ['date' => $date]);

        return $this->render('depense_form/form.html.twig', [
            'formUrl' => $formUrl,
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

            // Si la requête est AJAX, retournez une réponse JSON
            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(['success' => true]);
            }

            // Sinon, redirigez l'utilisateur
            return $this->redirectToRoute('accueil');
        }

        return $this->render('depense_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

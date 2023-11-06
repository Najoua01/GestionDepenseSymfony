<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepenseTwigController extends AbstractController
{
    #[Route('/depense/twig/{date}', name: 'depense_twig')]
    public function index($date): Response
    {
        return $this->render('depense_twig/index.html.twig', [
            'controller_name' => 'DepenseTwigController',
        ]);
    }
}

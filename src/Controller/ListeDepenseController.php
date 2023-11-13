<?php

namespace App\Controller;

use App\Entity\Depense;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeDepenseController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/liste-depense', name: 'liste_depense')]
    public function index(Request $request): Response
    {
        $date = $request->query->get('date');

        $depenses = $this->entityManager->getRepository(Depense::class)->findBy(['date' => $date]);

        $totalMontant = $this->getTotalMontant($date);

        return $this->render('liste_depense/index.html.twig', [
            'date' => $date,
            'depenses' => $depenses,
            'totalMontant' => $totalMontant,
        ]);
    }

    private function getTotalMontant(string $date): float
    {
        $query = $this->entityManager->createQuery('
            SELECT SUM(d.montant) as totalMontant
            FROM App\Entity\Depense d
            WHERE d.date = :date
        ');
        $query->setParameter('date', $date, Types::DATE_MUTABLE);

        $result = $query->getOneOrNullResult();

        return $result['totalMontant'] ?? 0;
    }
}

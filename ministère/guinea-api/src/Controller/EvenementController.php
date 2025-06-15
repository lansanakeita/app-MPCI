<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class EvenementController extends AbstractController
{
    private readonly EvenementRepository $evenementRepository;

    public function __construct(EvenementRepository $evenementRepository) {
        $this->evenementRepository = $evenementRepository;
    }


    /**
     * La liste des évènements
     */
    #[Route('/evenements', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $evenements = $this->evenementRepository->findAll();

        return $this->json(
            ['evenements' => $evenements],
            200,
            [],
            ['groups' => 'evenement:read']
        );    
    }


    /**
     * Récupérer l'évènement actif
     */
    #[Route('/evenement/actif', methods: ['GET'])]
    public function getEvenementActif(): JsonResponse
    {
        $evenement = $this->evenementRepository->findOneBy(['actif' => true]);

        if (!$evenement) {
            return $this->json(['message' => 'Aucun évènement actif trouvé'], 404);
        }

        return $this->json(
            ['evenement' => $evenement],
            200,
            [],
            ['groups' => 'evenement:read']
        );
    }


    

}

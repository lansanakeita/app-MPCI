<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Uid\Ulid;

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


    /**
     * 
     * 
     */
    // #[Route('/evenement/{id}', methods: ['GET'])]
    #[Route('/evenement/{id}', methods: ['GET'], requirements: ['id' => '[0-9A-HJKMNP-TV-Z]{26}'])]
    public function getEvenementById(string $id): JsonResponse
    {
        try {
            $ulid = new Ulid($id);
        } catch (\InvalidArgumentException $e) {
            return $this->json(['message' => 'ID invalide'], 400);
        }
    
        $evenement = $this->evenementRepository->find($ulid);
    
        if (!$evenement) {
            return $this->json(['message' => 'Événement non trouvé'], 404);
        }
    
        return $this->json(
            ['evenement' => $evenement],
            200,
            [],
            ['groups' => 'evenement:read']
        );
    }

}

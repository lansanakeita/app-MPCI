<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ParticipantController extends AbstractController
{
    // #[Route('/participant', name: 'app_participant')]
    // public function index(): Response
    // {
    //     return $this->render('participant/index.html.twig', [
    //         'controller_name' => 'ParticipantController',
    //     ]);
    // }

    #[Route('/evenement/inscription', methods: ['POST'])]
    public function register(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validation simple (à sécuriser davantage en prod)
        if (!isset($data['nom'], $data['prenom'], $data['evenement'])) {
            return $this->json(['message' => 'Champs requis manquants.'], Response::HTTP_BAD_REQUEST);
        }

        // Vérifie si l’événement existe
        $evenement = $em->getRepository(Evenement::class)->find($data['evenement']);
        if (!$evenement) {
            return $this->json(['message' => 'Événement non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        // Création du participant
        $participant = new Participant();
        $participant->setNom($data['nom']);
        $participant->setPrenom($data['prenom']);
        $participant->setEmail($data['email'] ?? null);
        $participant->setEvenement($evenement);

        $em->persist($participant);
        $em->flush();

        return $this->json(['message' => 'Inscription réussie'], Response::HTTP_CREATED);
    }
}

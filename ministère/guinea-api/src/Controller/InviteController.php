<?php

namespace App\Controller;

use App\Repository\InviteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Ulid;

final class InviteController extends AbstractController
{
    private readonly InviteRepository $inviteRepository; 

    public function __construct(InviteRepository $inviteRepository) {
        $this->inviteRepository = $inviteRepository;
    }


    #[Route('/invite/{id}', methods: ['GET'], requirements: ['id' => '[0-9A-HJKMNP-TV-Z]{26}'])]
    public function getInviteById(string $id): JsonResponse
    {
        try {
            $ulid = new Ulid($id); 
        } catch (\InvalidArgumentException $e) {
            return $this->json(['message' => 'ID invalide'], 400);
        }
    
        $invite = $this->inviteRepository->find($ulid);

    
        if (!$invite) {
            return $this->json(['message' => 'Événement non trouvé'], 404);
        }
    
        return $this->json(
            ['invite' => $invite],
            200
            // ['groups' => 'evenement:read']
        );
    }
}

<?php

namespace App\Entity;

use App\Repository\EtapeEvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: EtapeEvenementRepository::class)]
class EtapeEvenement
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column]
    // #[Groups(['evenement:read'])]
    // private ?int $id = null;

    #[ORM\Id]
    #[ORM\Column(type: 'ulid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    // #[Groups(['evenement:read'])]
    private ?Ulid $id = null;

    #[ORM\Column(length: 255)]
    // #[Groups(['evenement:read'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    // #[Groups(['evenement:read'])]
    private ?\DateTimeInterface $heureDebut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    // #[Groups(['evenement:read'])]
    private ?\DateTimeInterface $heureFin = null;

    #[ORM\ManyToOne(inversedBy: 'etapeEvenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?JourEvenement $jourEvenement = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    // #[Groups(['evenement:read'])]
    private ?string $activites = null;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }
    public function getId(): ?string
    {
        return $this->id?->__toString();
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): static
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): static
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getJourEvenement(): ?JourEvenement
    {
        return $this->jourEvenement;
    }

    public function setJourEvenement(?JourEvenement $jourEvenement): static
    {
        $this->jourEvenement = $jourEvenement;

        return $this;
    }

    public function getActivites(): ?string
    {
        return $this->activites;
    }

    public function setActivites(?string $activites): static
    {
        $this->activites = $activites;

        return $this;
    }
}

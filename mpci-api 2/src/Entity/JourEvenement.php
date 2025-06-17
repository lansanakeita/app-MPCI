<?php

namespace App\Entity;

use App\Repository\JourEvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: JourEvenementRepository::class)]
class JourEvenement
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column]

    #[ORM\Id]
    #[ORM\Column(type: 'ulid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    // #[Groups(['evenement:read'])]
    private ?Ulid $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    // #[Groups(['evenement:read'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    // #[Groups(['evenement:read'])]
    private ?string $titre = null;

    #[ORM\ManyToOne(inversedBy: 'jourEvenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evenement $evenement = null;

    /**
     * @var Collection<int, EtapeEvenement>
     */
    #[ORM\OneToMany(targetEntity: EtapeEvenement::class, mappedBy: 'jourEvenement', orphanRemoval: true)]
    // #[Groups(['evenement:read'])]
    private Collection $etapeEvenements;

    public function __construct()
    {
        $this->etapeEvenements = new ArrayCollection();
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }
    public function getId(): ?string
    {
        return $this->id?->__toString();
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
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

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): static
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * @return Collection<int, EtapeEvenement>
     */
    public function getEtapeEvenements(): Collection
    {
        return $this->etapeEvenements;
    }

    public function addEtapeEvenement(EtapeEvenement $etapeEvenement): static
    {
        if (!$this->etapeEvenements->contains($etapeEvenement)) {
            $this->etapeEvenements->add($etapeEvenement);
            $etapeEvenement->setJourEvenement($this);
        }

        return $this;
    }

    public function removeEtapeEvenement(EtapeEvenement $etapeEvenement): static
    {
        if ($this->etapeEvenements->removeElement($etapeEvenement)) {
            // set the owning side to null (unless already changed)
            if ($etapeEvenement->getJourEvenement() === $this) {
                $etapeEvenement->setJourEvenement(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->titre;
    }
}

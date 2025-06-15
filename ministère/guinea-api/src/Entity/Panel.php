<?php

namespace App\Entity;

use App\Repository\PanelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: PanelRepository::class)]
class Panel
{
    #[ORM\Id]
    #[ORM\Column(type: 'ulid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    #[Groups(['evenement:read'])]
    private ?Ulid $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['evenement:read'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['evenement:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'panels')]
    #[Groups(['evenement:read'])]
    private ?invite $moderateur = null;

    /**
     * @var Collection<int, invite>
     */
    #[ORM\ManyToMany(targetEntity: invite::class)]
    #[ORM\JoinTable(name: 'panel_invite')]
    #[Groups(['evenement:read'])]
    private Collection $panelistes;

    /**
     * @var Collection<int, invite>
     */
    #[ORM\ManyToMany(targetEntity: invite::class)]
    #[ORM\JoinTable(name: 'panel_conferencier')]
    #[Groups(['evenement:read'])]
    private Collection $conferenciers;

    #[ORM\ManyToOne(inversedBy: 'panels')]
    private ?evenement $evenement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['evenement:read'])]
    private ?\DateTimeInterface $date = null;

    public function __construct()
    {
        $this->panelistes = new ArrayCollection();
        $this->conferenciers = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id?->__toString();
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getModerateur(): ?invite
    {
        return $this->moderateur;
    }

    public function setModerateur(?invite $moderateur): static
    {
        $this->moderateur = $moderateur;

        return $this;
    }

    /**
     * @return Collection<int, invite>
     */
    public function getPanelistes(): Collection
    {
        return $this->panelistes;
    }

    public function addPaneliste(invite $paneliste): static
    {
        if (!$this->panelistes->contains($paneliste)) {
            $this->panelistes->add($paneliste);
        }

        return $this;
    }

    public function removePaneliste(invite $paneliste): static
    {
        $this->panelistes->removeElement($paneliste);

        return $this;
    }

    /**
     * @return Collection<int, invite>
     */
    public function getConferenciers(): Collection
    {
        return $this->conferenciers;
    }

    public function addConferencier(invite $conferencier): static
    {
        if (!$this->conferenciers->contains($conferencier)) {
            $this->conferenciers->add($conferencier);
        }

        return $this;
    }

    public function removeConferencier(invite $conferencier): static
    {
        $this->conferenciers->removeElement($conferencier);

        return $this;
    }

    public function getEvenement(): ?evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?evenement $evenement): static
    {
        $this->evenement = $evenement;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}

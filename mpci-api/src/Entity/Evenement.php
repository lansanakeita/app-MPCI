<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
#[Vich\Uploadable]
class Evenement
{
    #[ORM\Id]
    #[ORM\Column(type: 'ulid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    #[Groups(['evenement:read'])]
    private ?Ulid $id = null;
    
    #[ORM\Column(length: 255)]
    #[Groups(['evenement:read'])]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    #[Groups(['evenement:read'])]
    private ?string $theme = null;

    #[ORM\Column(length: 255)]
    #[Groups(['evenement:read'])]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    #[Groups(['evenement:read'])]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    #[Groups(['evenement:read'])]
    private ?string $pays = null;


    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Groups(['evenement:read'])]
    private ?\DateTimeImmutable $dateDebut = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Groups(['evenement:read'])]
    private ?\DateTimeImmutable $dateFin = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    // #[Groups(['evenement:read'])]
    private ?\DateTimeImmutable $dateCreation = null;

    /**
     * @var Collection<int, JourEvenement>
     */
    #[ORM\OneToMany(targetEntity: JourEvenement::class, mappedBy: 'evenement', orphanRemoval: true)]
    // #[Groups(['evenement:read'])]
    private Collection $jourEvenements;

    /**
     * @var Collection<int, Participant>
     */
    #[ORM\OneToMany(targetEntity: Participant::class, mappedBy: 'evenement')]
    private Collection $participants;

    #[ORM\Column]
    private ?bool $actif = false;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['evenement:read'])]
    private ?string $lienVideo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['evenement:read'])]
    private ?string $description = null;

    /**
     * @var Collection<int, Panel>
     */
    #[ORM\OneToMany(targetEntity: Panel::class, mappedBy: 'evenement')]
    #[Groups(['evenement:read'])]
    private Collection $panels;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'evenement_image', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    /**
     * @var Collection<int, ProgrammeImage>
     */
    #[ORM\OneToMany(targetEntity: ProgrammeImage::class, mappedBy: 'evenement', cascade: ['persist'], orphanRemoval: true)]
    #[Groups(['evenement:read'])]
    private Collection $programmeImages;


    

    public function __construct()
    {
        $this->jourEvenements = new ArrayCollection();
        $this->participants = new ArrayCollection();
        $this->dateCreation = new \DateTimeImmutable();
        $this->panels = new ArrayCollection();
        $this->programmeImages = new ArrayCollection();
    }

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

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeImmutable
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeImmutable $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeImmutable
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeImmutable $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeImmutable $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, JourEvenement>
     */
    public function getJourEvenements(): Collection
    {
        return $this->jourEvenements;
    }

    public function addJourEvenement(JourEvenement $jourEvenement): static
    {
        if (!$this->jourEvenements->contains($jourEvenement)) {
            $this->jourEvenements->add($jourEvenement);
            $jourEvenement->setEvenement($this);
        }

        return $this;
    }

    public function removeJourEvenement(JourEvenement $jourEvenement): static
    {
        if ($this->jourEvenements->removeElement($jourEvenement)) {
            // set the owning side to null (unless already changed)
            if ($jourEvenement->getEvenement() === $this) {
                $jourEvenement->setEvenement(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->titre;
    }

    /**
     * @return Collection<int, Participant>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->setEvenement($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): static
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getEvenement() === $this) {
                $participant->setEvenement(null);
            }
        }

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getLienVideo(): ?string
    {
        return $this->lienVideo;
    }

    public function setLienVideo(?string $lienVideo): static
    {
        $this->lienVideo = $lienVideo;

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

    /**
     * @return Collection<int, Panel>
     */
    public function getPanels(): Collection
    {
        return $this->panels;
    }

    public function addPanel(Panel $panel): static
    {
        if (!$this->panels->contains($panel)) {
            $this->panels->add($panel);
            $panel->setEvenement($this);
        }

        return $this;
    }

    public function removePanel(Panel $panel): static
    {
        if ($this->panels->removeElement($panel)) {
            // set the owning side to null (unless already changed)
            if ($panel->getEvenement() === $this) {
                $panel->setEvenement(null);
            }
        }

        return $this;
    }

    // #[Groups(['evenement:read'])]
    // public function getImageUrl(): ?string
    // {
    //     return $this->image
    //     ? 'http://localhost:8000/uploads/evenements/' . $this->image
    //     : null;
    // }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            // Mise à jour pour déclencher Doctrine
            $this->dateCreation = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @return Collection<int, ProgrammeImage>
     */
    public function getProgrammeImages(): Collection
    {
        return $this->programmeImages;
    }

    public function addProgrammeImage(ProgrammeImage $programmeImage): static
    {
        if (!$this->programmeImages->contains($programmeImage)) {
            $this->programmeImages->add($programmeImage);
            $programmeImage->setEvenement($this);
        }

        return $this;
    }

    public function removeProgrammeImage(ProgrammeImage $programmeImage): static
    {
        if ($this->programmeImages->removeElement($programmeImage)) {
            // set the owning side to null (unless already changed)
            if ($programmeImage->getEvenement() === $this) {
                $programmeImage->setEvenement(null);
            }
        }

        return $this;
    }
}

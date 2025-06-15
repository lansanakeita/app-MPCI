<?php

namespace App\Entity;

use App\Repository\InviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: InviteRepository::class)]
#[Vich\Uploadable]
class Invite
{

    #[ORM\Id]
    #[ORM\Column(type: 'ulid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    #[Groups(['evenement:read'])]
    private ?Ulid $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['evenement:read'])]
    private ?string $poste = null;

    #[ORM\Column(length: 255)]
    #[Groups(['evenement:read'])]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['evenement:read'])]
    private ?string $biographie = null;

    /**
     * @var Collection<int, Panel>
     */
    #[ORM\OneToMany(targetEntity: Panel::class, mappedBy: 'moderateur')]
    private Collection $panels;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[Vich\UploadableField(mapping: 'invite_photo',fileNameProperty: 'photo')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;  
    

    public function __construct()
    {
        $this->panels = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id?->__toString();
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(?string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(?string $biographie): static
    {
        $this->biographie = $biographie;

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
            $panel->setModerateur($this);
        }

        return $this;
    }

    public function removePanel(Panel $panel): static
    {
        if ($this->panels->removeElement($panel)) {
            // set the owning side to null (unless already changed)
            if ($panel->getModerateur() === $this) {
                $panel->setModerateur(null);
            }
        }

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            // Mise à jour pour déclencher Doctrine
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    #[Groups(['evenement:read'])]
    public function getPhotoUrl(): ?string
    {
        return $this->photo
        ? 'http://localhost:8000/uploads/invites/' . $this->photo
        : null;
    }

    public function __toString(): string
    {
        return $this->nom ?? 'Invite';
    }
}

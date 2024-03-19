<?php

namespace App\Entity;

use App\Repository\FullChildRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FullChildRepository::class)]
class FullChild
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le nom doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $nom = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le prenom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le prenom doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $age = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $genre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
     #[Assert\Length(
        min: 2,
        max: 500,
        minMessage: ' doit contenir au moins {{ limit }} caractères',
        maxMessage: ' doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $consigne_alimentaire = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 500,
        minMessage: ' doit contenir au moins {{ limit }} caractères',
        maxMessage: 'doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $traitement = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $vaccin = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank] 
    #[Assert\Length(
        min: 2,
        max: 500,
        minMessage: 'doit contenir au moins {{ limit }} caractères',
        maxMessage: 'doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $alergie = null;

    #[ORM\OneToMany(targetEntity: Rdv::class, mappedBy: 'id_child', orphanRemoval: true)]
    private Collection $child;

    public function __construct()
    {
        $this->child = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getConsigneAlimentaire(): ?string
    {
        return $this->consigne_alimentaire;
    }

    public function setConsigneAlimentaire(string $consigne_alimentaire): static
    {
        $this->consigne_alimentaire = $consigne_alimentaire;

        return $this;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(string $traitement): static
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getVaccin(): ?int
    {
        return $this->vaccin;
    }

    public function setVaccin(int $vaccin): static
    {
        $this->vaccin = $vaccin;

        return $this;
    }

    public function getAlergie(): ?string
    {
        return $this->alergie;
    }

    public function setAlergie(string $alergie): static
    {
        $this->alergie = $alergie;

        return $this;
    }

    /**
     * @return Collection<int, Rdv>
     */
    public function getChild(): Collection
    {
        return $this->child;
    }

    public function addChild(Rdv $child): static
    {
        if (!$this->child->contains($child)) {
            $this->child->add($child);
            $child->setIdChild($this);
        }

        return $this;
    }

    public function removeChild(Rdv $child): static
    {
        if ($this->child->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getIdChild() === $this) {
                $child->setIdChild(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\TableauDeBordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TableauDeBordRepository::class)
 */
class TableauDeBord
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modification;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tableau_de_bord")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=TypeRapport::class, inversedBy="tableauDeBord")
     */
    private $type_rapport;

    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="tableau_bord")
     */
    private $projet;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->date_modification = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $date_modification =  new \DateTime();
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {

        $this->user = $user;

        return $this;
    }

    public function getTypeRapport(): ?TypeRapport
    {
        return $this->type_rapport;
    }


    public function setTypeRapport(?TypeRapport $typeRapport): self
    {
        $this->type_rapport = $typeRapport;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getTypeRapport();
    }
}

<?php

namespace App\Entity;

use App\Repository\TypeRapportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRapportRepository::class)
 */
class TypeRapport
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
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=TableauDeBord::class, mappedBy="type_rapport")
     */
    private $tableauDeBord;

    public function __construct()
    {
        $this->tableauDeBord = new ArrayCollection();
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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


    /**
     * @return Collection|TableauDeBord[]
     */
    public function getTableauDeBord(): Collection
    {
        return $this->tableauDeBord;
    }

    public function addTableauDeBord(TableauDeBord $tableauDeBord): self
    {
        if (!$this->tableauDeBord->contains($tableauDeBord)) {
            $this->tableauDeBord[] = $tableauDeBord;
            $tableauDeBord->setTypeRapport($this);
        }

        return $this;
    }

    public function removeTableauDeBord(TableauDeBord $tableauDeBord): self
    {
        if ($this->tableauDeBord->removeElement($tableauDeBord)) {
            // set the owning side to null (unless already changed)
            if ($tableauDeBord->getTypeRapport() === $this) {
                $tableauDeBord->setTypeRapport(null);
            }
        }

        return $this;
    }

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getNom();
    }
}

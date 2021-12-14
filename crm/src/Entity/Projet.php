<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
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
     * @ORM\Column(type="string", length=255)
     */
    private $type_projet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modification;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $langage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avancement_projet;

    /**
     * @ORM\Column(type="text")
     */
    private $description_projet;

    /**
     * @ORM\OneToMany(targetEntity=Factures::class, mappedBy="projet")
     */
    private $facture;

    /**
     * @ORM\OneToMany(targetEntity=Fichiers::class, mappedBy="projet")
     */
    private $fichier;

    /**
     * @ORM\ManyToMany(targetEntity=Societes::class, inversedBy="projet", cascade={"persist"})
     */
    private $societe;

    /**
     * @ORM\OneToMany(targetEntity=TableauDeBord::class, mappedBy="projet")
     */
    private $tableau_bord;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity=CalendrierMaintenance::class, mappedBy="projet")
     */
    private $calendrierMaintenances;

    public function __construct()
    {
        $this->facture = new ArrayCollection();
        $this->fichier = new ArrayCollection();
        $this->tableau_bord = new ArrayCollection();
        $this->societe = new ArrayCollection();
        $this->created_at = new \DateTime();
        $this->date_modification = new \DateTime();
        $this->calendrierMaintenances = new ArrayCollection();
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

    public function getTypeProjet(): ?string
    {
        return $this->type_projet;
    }

    public function setTypeProjet(string $type_projet): self
    {
        $this->type_projet = $type_projet;

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
        return $this->date_modification ?? new \DateTime();
    }

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getLangage(): ?string
    {
        return $this->langage;
    }

    public function setLangage(string $langage): self
    {
        $this->langage = $langage;

        return $this;
    }

    public function getAvancementProjet(): ?string
    {
        return $this->avancement_projet;
    }

    public function setAvancementProjet(string $avancement_projet): self
    {
        $this->avancement_projet = $avancement_projet;

        return $this;
    }

    public function getDescriptionProjet(): ?string
    {
        return $this->description_projet;
    }

    public function setDescriptionProjet(string $description_projet): self
    {
        $this->description_projet = $description_projet;

        return $this;
    }

    /**
     * @return Collection|Factures[]
     */
    public function getFacture(): Collection
    {
        return $this->facture;
    }

    public function addFacture(Factures $facture): self
    {
        if (!$this->facture->contains($facture)) {
            $this->facture[] = $facture;
            $facture->setProjet($this);
        }

        return $this;
    }

    public function removeFacture(Factures $facture): self
    {
        if ($this->facture->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getProjet() === $this) {
                $facture->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fichiers[]
     */
    public function getFichier(): Collection
    {
        return $this->fichier;
    }

    public function addFichier(Fichiers $fichier): self
    {
        if (!$this->fichier->contains($fichier)) {
            $this->fichier[] = $fichier;
            $fichier->setProjet($this);
        }

        return $this;
    }

    public function removeFichier(Fichiers $fichier): self
    {
        if ($this->fichier->removeElement($fichier)) {
            // set the owning side to null (unless already changed)
            if ($fichier->getProjet() === $this) {
                $fichier->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Societes[]
     */
    public function getSociete(): Collection
    {
        return $this->societe;
    }

    public function addSociete(Societes $societes): self
    {
        if (!$this->societe->contains($societes)) {
            $this->societe[] = $societes;
            $societes->setProjet($this);
        }

        return $this;
    }

    public function removeSociete(Societes $societes): self
    {
        if ($this->societe->removeElement($societes)) {
            // set the owning side to null (unless already changed)
            if ($societes->getProjet() === $this) {
                $societes->setProjet(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection|TableauDeBord[]
     */
    public function getTableauBord(): Collection
    {
        return $this->tableau_bord;
    }

    public function addTableauBord(TableauDeBord $tableauBord): self
    {
        if (!$this->tableau_bord->contains($tableauBord)) {
            $this->tableau_bord[] = $tableauBord;
            $tableauBord->setProjet($this);
        }

        return $this;
    }

    public function removeTableauBord(TableauDeBord $tableauBord): self
    {
        if ($this->tableau_bord->removeElement($tableauBord)) {
            // set the owning side to null (unless already changed)
            if ($tableauBord->getProjet() === $this) {
                $tableauBord->setProjet(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

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

    /**
     * @return Collection|CalendrierMaintenance[]
     */
    public function getCalendrierMaintenances(): Collection
    {
        return $this->calendrierMaintenances;
    }

    public function addCalendrierMaintenance(CalendrierMaintenance $calendrierMaintenance): self
    {
        if (!$this->calendrierMaintenances->contains($calendrierMaintenance)) {
            $this->calendrierMaintenances[] = $calendrierMaintenance;
            $calendrierMaintenance->setProjet($this);
        }

        return $this;
    }

    public function removeCalendrierMaintenance(CalendrierMaintenance $calendrierMaintenance): self
    {
        if ($this->calendrierMaintenances->removeElement($calendrierMaintenance)) {
            // set the owning side to null (unless already changed)
            if ($calendrierMaintenance->getProjet() === $this) {
                $calendrierMaintenance->setProjet(null);
            }
        }

        return $this;
    }
}

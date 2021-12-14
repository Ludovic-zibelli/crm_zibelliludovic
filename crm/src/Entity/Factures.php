<?php

namespace App\Entity;

use App\Repository\FacturesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacturesRepository::class)
 */
class Factures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero_de_facture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_de_paiement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $payer;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_facture;

    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="facture")
     */
    private $projet;

    /**
     * @ORM\Column(type="boolean")
     */
    private $facture_devis;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee_exercice;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $date = new \DateTime('now');
        $dateFormat = $date->format("Y");
        $this->annee_exercice = $dateFormat;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNumeroDeFacture(): ?string
    {
        return $this->numero_de_facture;
    }

    public function setNumeroDeFacture(string $numero_de_facture): self
    {
        $this->numero_de_facture = $numero_de_facture;

        return $this;
    }

    public function getDateDePaiement(): ?\DateTimeInterface
    {
        return $this->date_de_paiement;
    }

    public function setDateDePaiement(\DateTimeInterface $date_de_paiement): self
    {
        $this->date_de_paiement = $date_de_paiement;

        return $this;
    }

    public function getPayer(): ?bool
    {
        return $this->payer;
    }

    public function setPayer(bool $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    public function getMontantFacture(): ?float
    {
        return $this->montant_facture;
    }

    public function setMontantFacture(float $montant_facture): self
    {
        $this->montant_facture = $montant_facture;

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

    public function getFactureDevis(): ?bool
    {
        return $this->facture_devis;
    }

    public function setFactureDevis(bool $facture_devis): self
    {
        $this->facture_devis = $facture_devis;

        return $this;
    }

    public function getAnneeExercice(): ?int
    {
        return $this->annee_exercice;
    }

    public function setAnneeExercice(int $annee_exercice): self
    {
        $this->annee_exercice = $annee_exercice;

        return $this;
    }
}

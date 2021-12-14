<?php


namespace App\Entity;


class FactureRecherche
{
    /**
     * @var string|null
     */
    private $numeroFacture;

    /**
     * @var string|null
     */
    private $projet;

    /**
     * @var boolean|null
     */
    private $factureDevis;

    /**
     * @return bool|null
     */
    public function getFactureDevis(): ?bool
    {
        return $this->factureDevis;
    }

    /**
     * @param bool|null $factureDevis
     */
    public function setFactureDevis(?bool $factureDevis): void
    {
        $this->factureDevis = $factureDevis;
    }

    /**
     * @return string|null
     */
    public function getNumeroFacture(): ?string
    {
        return $this->numeroFacture;
    }

    /**
     * @param string|null $numeroFacture
     */
    public function setNumeroFacture(?string $numeroFacture): void
    {
        $this->numeroFacture = $numeroFacture;
    }

    /**
     * @return string|null
     */
    public function getProjet(): ?string
    {
        return $this->projet;
    }

    /**
     * @param string|null $projet
     */
    public function setProjet(?string $projet): void
    {
        $this->projet = $projet;
    }

}
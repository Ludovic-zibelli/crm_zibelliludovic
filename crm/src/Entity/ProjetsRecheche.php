<?php

namespace App\Entity;

class ProjetsRecheche
{
    /**
     * @var int|null
     */
    private $numeroProjet;

    /**
     * @var string|null
     */
    private $nomProjet;

    /**
     * @var string|null
     */
    private $societe;

    /**
     * @return int|null
     */
    public function getNumeroProjet(): ?int
    {
        return $this->numeroProjet;
    }

    /**
     * @param int|null $numeroProjet
     */
    public function setNumeroProjet(?int $numeroProjet): void
    {
        $this->numeroProjet = $numeroProjet;
    }

    /**
     * @return string|null
     */
    public function getNomProjet(): ?string
    {
        return $this->nomProjet;
    }

    /**
     * @param string|null $nomProjet
     */
    public function setNomProjet(?string $nomProjet): void
    {
        $this->nomProjet = $nomProjet;
    }

    /**
     * @return string|null
     */
    public function getSociete(): ?string
    {
        return $this->societe;
    }

    /**
     * @param string|null $societe
     */
    public function setSociete(?string $societe): void
    {
        $this->societe = $societe;
    }

}
<?php


namespace App\Entity;


class MaintenanceRecherche
{

    /**
     * @var string|null
     */
    private $projet;

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
<?php
namespace App\Entity;

class ClientRecherche
{

    /**
     * @var int|null
     */
    private $numeroClient;

    /**
     * @var string|null
     */
    private $nomSociete;

    /**
     * @return int|null
     */
    public function getNumeroClient(): ?int
    {
        return $this->numeroClient;
    }

    /**
     * @param int|null $numeroClient
     */
    public function setNumeroClient(?int $numeroClient): void
    {
        $this->numeroClient = $numeroClient;
    }

    /**
     * @return string|null
     */
    public function getNomSociete(): ?string
    {
        return $this->nomSociete;
    }

    /**
     * @param string|null $nomSociete
     */
    public function setNomSociete(?string $nomSociete): void
    {
        $this->nomSociete = $nomSociete;
    }



}
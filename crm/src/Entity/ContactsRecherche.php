<?php
namespace App\Entity;

class ContactsRecherche
{
    /**
     * @var string|null
     */
    private $nom;

    /**
     * @var string|null
     */
    private $societe;

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
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
    public function setSociete(string $societe): void
    {
        $this->societe = $societe;
    }
}
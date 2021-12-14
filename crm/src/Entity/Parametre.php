<?php

namespace App\Entity;

use App\Repository\ParametreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParametreRepository::class)
 */
class Parametre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $adresse_facturation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse_webmail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresseFacturation(): ?string
    {
        return $this->adresse_facturation;
    }

    public function setAdresseFacturation(string $adresse_facturation): self
    {
        $this->adresse_facturation = $adresse_facturation;

        return $this;
    }

    public function getAdresseWebmail(): ?string
    {
        return $this->adresse_webmail;
    }

    public function setAdresseWebmail(?string $adresse_webmail): self
    {
        $this->adresse_webmail = $adresse_webmail;

        return $this;
    }
}

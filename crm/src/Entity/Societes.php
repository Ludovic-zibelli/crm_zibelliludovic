<?php

namespace App\Entity;

use App\Repository\SocietesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocietesRepository::class)
 */
class Societes
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raison_sociale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero_siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genre_de_societe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site_web;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autre_infos;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_modification;

    /**
     * @ORM\OneToMany(targetEntity=Interlocuteurs::class, mappedBy="societe")
     */
    private $interlocuteurs;

    /**
     * @ORM\ManyToMany(targetEntity=Projet::class, mappedBy="societe", cascade={"persist"} )
     */
    private $projet;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $adresse_postal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    public function __construct()
    {
        $this->interlocuteurs = new ArrayCollection();
        $this->projet = new ArrayCollection();
        $this->created_at = new \DateTime();
        $this->date_modification = new \DateTime();
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

    public function getRaisonSociale(): ?string
    {
        return $this->raison_sociale;
    }

    public function setRaisonSociale(?string $raison_sociale): self
    {
        $this->raison_sociale = $raison_sociale;

        return $this;
    }

    public function getNumeroSiret(): ?string
    {
        return $this->numero_siret;
    }

    public function setNumeroSiret(?string $numero_siret): self
    {
        $this->numero_siret = $numero_siret;

        return $this;
    }

    public function getGenreDeSociete(): ?string
    {
        return $this->genre_de_societe;
    }

    public function setGenreDeSociete(?string $genre_de_societe): self
    {
        $this->genre_de_societe = $genre_de_societe;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->site_web;
    }

    public function setSiteWeb(?string $site_web): self
    {
        $this->site_web = $site_web;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getAutreInfos(): ?string
    {
        return $this->autre_infos;
    }

    public function setAutreInfos(?string $autre_infos): self
    {
        $this->autre_infos = $autre_infos;

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

    public function setDateModification(?\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    /**
     * @return Collection|Interlocuteurs[]
     */
    public function getInterlocuteurs(): Collection
    {
        return $this->interlocuteurs;
    }

    public function addInterlocuteur(Interlocuteurs $interlocuteur): self
    {
        if (!$this->interlocuteurs->contains($interlocuteur)) {
            $this->interlocuteurs[] = $interlocuteur;
            $interlocuteur->setSociete($this);
        }

        return $this;
    }

    public function removeInterlocuteur(Interlocuteurs $interlocuteur): self
    {
        if ($this->interlocuteurs->removeElement($interlocuteur)) {
            // set the owning side to null (unless already changed)
            if ($interlocuteur->getSociete() === $this) {
                $interlocuteur->setSociete(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjet(): Collection
    {
        return $this->projet;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projet->contains($projet)) {
            $this->projet[] = $projet;
            $projet->setSociete($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projet->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getSociete() === $this) {
                $projet->setSociete(null);
            }
        }

        return $this;
    }


    public function getAdressePostal(): ?string
    {
        return $this->adresse_postal;
    }

    public function setAdressePostal(string $adresse_postal): self
    {
        $this->adresse_postal = $adresse_postal;

        return $this;
    }

    public function getCodePostal(): ?float
    {
        return $this->code_postal;
    }

    public function setCodePostal(?float $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

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

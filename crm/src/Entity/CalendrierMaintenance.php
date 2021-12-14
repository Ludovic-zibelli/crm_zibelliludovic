<?php

namespace App\Entity;

use App\Repository\CalendrierMaintenanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalendrierMaintenanceRepository::class)
 */
class CalendrierMaintenance
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
    private $creatd_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $backgroundcolor;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $bordercolor;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $textcolor;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rrufreq;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rruinterval;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rrubyweekday;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rrudstart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $rruuntil;

    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="calendrierMaintenances")
     */
    private $projet;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function __construct()
    {
        $this->creatd_at = new \DateTime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatdAt(): ?\DateTimeInterface
    {
        return $this->creatd_at;
    }

    public function setCreatdAt(\DateTimeInterface $creatd_at): self
    {
        $this->creatd_at = $creatd_at;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundcolor;
    }

    public function setBackgroundColor(string $backgroundcolor): self
    {
        $this->backgroundcolor = $backgroundcolor;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->bordercolor;
    }

    public function setBorderColor(string $bordercolor): self
    {
        $this->bordercolor = $bordercolor;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textcolor;
    }

    public function setTextColor(string $textcolor): self
    {
        $this->textcolor = $textcolor;

        return $this;
    }

    public function getrruFreq(): ?string
    {
        return $this->rrufreq;
    }

    public function setrruFreq(string $rrufreq): self
    {
        $this->rrufreq = $rrufreq;

        return $this;
    }

    public function getrruInterval(): ?string
    {
        return $this->rruinterval;
    }

    public function setrruInterval(string $rruinterval): self
    {
        $this->rruinterval = $rruinterval;

        return $this;
    }

    public function getrruByweekday(): ?string
    {
        return $this->rrubyweekday;
    }

    public function setrruByweekday(string $rrubyweekday): self
    {
        $this->rrubyweekday = $rrubyweekday;

        return $this;
    }

    public function getrruDstart(): ?\DateTimeInterface
    {
        return $this->rrudstart;
    }

    public function setrruDstart(\DateTimeInterface $rrudstart): self
    {
        $this->rrudstart = $rrudstart;

        return $this;
    }

    public function getrruUntil(): ?\DateTimeInterface
    {
        return $this->rruuntil;
    }

    public function setrruUntil(?\DateTimeInterface $rruuntil): self
    {
        $this->rruuntil = $rruuntil;

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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}

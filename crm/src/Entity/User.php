<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
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
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

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
    private $poste;

    /**
     * @ORM\OneToMany(targetEntity=TableauDeBord::class, mappedBy="user")
     */
    private $tableau_de_bord;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $role;

    public function __construct()
    {
        $this->tableau_de_bord = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * @return Collection|TableauDeBord[]
     */
    public function getTableauDeBord(): Collection
    {
        return $this->tableau_de_bord;
    }

    public function addTableauDeBord(TableauDeBord $tableauDeBord): self
    {
        if (!$this->tableau_de_bord->contains($tableauDeBord)) {
            $this->tableau_de_bord[] = $tableauDeBord;
            $tableauDeBord->setUser($this);
        }

        return $this;
    }

    public function removeTableauDeBord(TableauDeBord $tableauDeBord): self
    {
        if ($this->tableau_de_bord->removeElement($tableauDeBord)) {
            // set the owning side to null (unless already changed)
            if ($tableauDeBord->getUser() === $this) {
                $tableauDeBord->setUser(null);
            }
        }

        return $this;
    }

    public function getRole(): ?string
    {
        //return $this->role;
        $roles = $this->role;
        // il est obligatoire d'avoir au moins un rôle si on est authentifié, par convention c'est ROLE_USER
        //if (empty($roles)) {
          //  $roles[] = 'ROLE_USER';
        //}

        return $roles;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getRoles()
    {
        return array('ROLE_ADMIN');
        //return $this->role;
        // TODO: Implement getRoles() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
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

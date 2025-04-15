<?php

namespace App\Entity;

use App\Repository\DocteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocteurRepository::class)]
class Docteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column]
    private ?bool $chef ;

    #[ORM\ManyToOne(inversedBy: 'docteurs')]
    private ?Hopital $Hopital = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function isChef(): ?bool
    {
        return (bool) $this->chef;
    }

    public function setChef(bool $chef): static
    {
        $this->chef = $chef;

        return $this;
    }

    public function getHopital(): ?Hopital
    {
        return $this->Hopital;
    }

    public function setHopital(?Hopital $Hopital): static
    {
        $this->Hopital = $Hopital;

        return $this;
    }
}

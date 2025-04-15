<?php

namespace App\Entity;

use App\Repository\HopitalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HopitalRepository::class)]
class Hopital
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = "";

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;
   
   

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $fax = null;

    /**
     * @var Collection<int, Docteur>
     */
    #[ORM\OneToMany(targetEntity: Docteur::class, mappedBy: 'Hopital')]
    private Collection $docteurs;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function __construct()
    {
        $this->docteurs = new ArrayCollection();
    }
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): static
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return Collection<int, Docteur>
     */
    public function getDocteurs(): Collection
    {
        return $this->docteurs;
    }

    public function addDocteur(Docteur $docteur): static
    {
        if (!$this->docteurs->contains($docteur)) {
            $this->docteurs->add($docteur);
            $docteur->setHopital($this);
        }

        return $this;
    }

    public function removeDocteur(Docteur $docteur): static
    {
        if ($this->docteurs->removeElement($docteur)) {
            // set the owning side to null (unless already changed)
            if ($docteur->getHopital() === $this) {
                $docteur->setHopital(null);
            }
        }

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
}

<?php

namespace App\Entity;

use App\Repository\SouscategorieOutilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SouscategorieOutilRepository::class)]
class SouscategorieOutil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\ManyToOne(inversedBy: 'SouscategorieOutils')]
  
   
    private ?categorieOutil $categorieOutil = null;

    /**
     * @var Collection<int, Outil>
     */
    #[ORM\OneToMany(targetEntity: Outil::class, mappedBy: 'souscategorieOutil')]
   
    private Collection $outils;

    public function __construct()
    {
        $this->outils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCategorieOutil(): ?CategorieOutil
    {
        return $this->categorieOutil;
    }
    
    public function setCategorieOutil(?CategorieOutil $CategorieOutil): self
    {
        $this->categorieOutil = $CategorieOutil;
        return $this;
    }

    /**
     * @return Collection<int, Outil>
     */
    public function getOutils(): Collection
    {
        return $this->outils;
    }

    public function addOutil(Outil $outil): static
    {
        if (!$this->outils->contains($outil)) {
            $this->outils->add($outil);
            $outil->setSouscategorieOutil($this);
        }

        return $this;
    }

    public function removeOutil(Outil $outil): static
    {
        if ($this->outils->removeElement($outil)) {
            // set the owning side to null (unless already changed)
            if ($outil->getSouscategorieOutil() === $this) {
                $outil->setSouscategorieOutil(null);
            }
        }

        return $this;
    }
}

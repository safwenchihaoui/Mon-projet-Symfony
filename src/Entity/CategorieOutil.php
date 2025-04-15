<?php

namespace App\Entity;

use App\Repository\CategorieOutilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieOutilRepository::class)]
class CategorieOutil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    /**
     * @var Collection<int, SouscategorieOutil>
     */
    #[ORM\OneToMany(targetEntity: SouscategorieOutil::class, mappedBy: 'categorieOutil')]
    private Collection $souscategorieOutils;

    public function __construct()
    {
        $this->souscategorieOutils = new ArrayCollection();
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

    /**
     * @return Collection<int, SouscategorieOutil>
     */
    public function getSouscategorieOutils(): Collection
    {
        return $this->souscategorieOutils;
    }

    public function addSouscategorieOutil(SouscategorieOutil $souscategorieOutil): static
    {
        if (!$this->souscategorieOutils->contains($souscategorieOutil)) {
            $this->souscategorieOutils->add($souscategorieOutil);
            $souscategorieOutil->setCategorieOutil($this);
        }

        return $this;
    }

    public function removeSouscategorieOutil(SouscategorieOutil $souscategorieOutil): static
    {
        if ($this->souscategorieOutils->removeElement($souscategorieOutil)) {
            // set the owning side to null (unless already changed)
            if ($souscategorieOutil->getCategorieOutil() === $this) {
                $souscategorieOutil->setCategorieOutil(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CategorieRecommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRecommandRepository::class)]
class CategorieRecommand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

   

    /**
     * @var Collection<int, SouscategorieRecommand>
     */
    #[ORM\OneToMany(targetEntity: SouscategorieRecommand::class, mappedBy: 'CategorieRecommand')]
    private Collection $souscategorieRecommands;

    public function __construct()
    {
        $this->souscategorieRecommands = new ArrayCollection();
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
    public function __toString(): string
    {
        return $this->titre ?? 'CategorieRecommand'; 
    }



    /**
     * @return Collection<int, SouscategorieRecommand>
     */
    public function getSouscategorieRecommands(): Collection
    {
        return $this->souscategorieRecommands;
    }

    public function addSouscategorieRecommand(SouscategorieRecommand $souscategorieRecommand): static
    {
        if (!$this->souscategorieRecommands->contains($souscategorieRecommand)) {
            $this->souscategorieRecommands->add($souscategorieRecommand);
            $souscategorieRecommand->setCategorieRecommand($this);
        }

        return $this;
    }

    public function removeSouscategorieRecommand(SouscategorieRecommand $souscategorieRecommand): static
    {
        if ($this->souscategorieRecommands->removeElement($souscategorieRecommand)) {
            // set the owning side to null (unless already changed)
            if ($souscategorieRecommand->getCategorieRecommand() === $this) {
                $souscategorieRecommand->setCategorieRecommand(null);
            }
        }

        return $this;
    }

   

   

   

    
}

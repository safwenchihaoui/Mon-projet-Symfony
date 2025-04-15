<?php

namespace App\Entity;

use App\Repository\SouscategorieRecommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SouscategorieRecommandRepository::class)]
class SouscategorieRecommand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    

    #[ORM\ManyToOne(targetEntity: CategorieRecommand::class ,inversedBy: 'souscategorieRecommands')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL' )]
    private ?CategorieRecommand $CategorieRecommand ;

    /**
     * @var Collection<int, Recommandation>
     */
    #[ORM\OneToMany(targetEntity: Recommandation::class, mappedBy: 'SouscategorieRecommand' )]
    private Collection $recommandations;

    public function __construct()
    {
        $this->recommandations = new ArrayCollection();
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

   

   

    public function getCategorieRecommand(): ?CategorieRecommand
    {
        return $this->CategorieRecommand;
    }

    public function setCategorieRecommand(?CategorieRecommand $CategorieRecommand): static
    {
        $this->CategorieRecommand = $CategorieRecommand;

        return $this;
    }

    /**
     * @return Collection<int, Recommandation>
     */
    public function getRecommandations(): Collection
    {
        return $this->recommandations;
    }

    public function addRecommandation(Recommandation $recommandation): static
    {
        if (!$this->recommandations->contains($recommandation)) {
            $this->recommandations->add($recommandation);
            $recommandation->setSouscategorieRecommand($this);
        }

        return $this;
    }

    public function removeRecommandation(Recommandation $recommandation): static
    {
        if ($this->recommandations->removeElement($recommandation)) {
            // set the owning side to null (unless already changed)
            if ($recommandation->getSouscategorieRecommand() === $this) {
                $recommandation->setSouscategorieRecommand(null);
            }
        }

        return $this;
    }
}

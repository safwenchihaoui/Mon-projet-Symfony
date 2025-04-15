<?php

namespace App\Entity;

use App\Repository\CategorieEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieEventRepository::class)]
class CategorieEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    /**
     * @var Collection<int, Evennement>
     */
    #[ORM\OneToMany(targetEntity: Evennement::class, mappedBy: 'CategorieEvent')]
    private Collection $evennements;

    public function __construct()
    {
        $this->evennements = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection<int, Evennement>
     */
    public function getEvennements(): Collection
    {
        return $this->evennements;
    }

    public function addEvennement(Evennement $evennement): static
    {
        if (!$this->evennements->contains($evennement)) {
            $this->evennements->add($evennement);
            $evennement->setCategorieEvent($this);
        }

        return $this;
    }

    public function removeEvennement(Evennement $evennement): static
    {
        if ($this->evennements->removeElement($evennement)) {
            // set the owning side to null (unless already changed)
            if ($evennement->getCategorieEvent() === $this) {
                $evennement->setCategorieEvent(null);
            }
        }

        return $this;
    }
}

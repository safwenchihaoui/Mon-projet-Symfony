<?php

namespace App\Entity;

use App\Repository\EvennementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvennementRepository::class)]
class Evennement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;
    


    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedeb = null;
    #[ORM\Column(type: 'string', length: 255)]
 private ?string $lieu = null;



    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datefin = null;

    #[ORM\ManyToOne(inversedBy: 'evennements')]
    private ?CategorieEvent $CategorieEvent = null;

    /**
     * @var Collection<int, Sousmission>
     */
    #[ORM\OneToMany(targetEntity: Sousmission::class, mappedBy: 'Evennement')]
    private Collection $sousmissions;

    

    public function __construct()
    {
        $this->sousmissions = new ArrayCollection();
    }
    public function getLieu(): ?string
    {
        return $this->lieu;
    }
    
    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;
    
        return $this;
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

    public function getDatedeb(): ?\DateTimeInterface
    {
        return $this->datedeb;
    }

    public function setDatedeb(\DateTimeInterface $datedeb): static
    {
        $this->datedeb = $datedeb;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): static
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getCategorieEvent(): ?CategorieEvent
    {
        return $this->CategorieEvent;
    }

    public function setCategorieEvent(?CategorieEvent $CategorieEvent): static
    {
        $this->CategorieEvent = $CategorieEvent;

        return $this;
    }

    /**
     * @return Collection<int, Sousmission>
     */
    public function getSousmissions(): Collection
    {
        return $this->sousmissions;
    }

    public function addSousmission(Sousmission $sousmission): static
    {
        if (!$this->sousmissions->contains($sousmission)) {
            $this->sousmissions->add($sousmission);
            $sousmission->setEvennement($this);
        }

        return $this;
    }

    public function removeSousmission(Sousmission $sousmission): static
    {
        if ($this->sousmissions->removeElement($sousmission)) {
            // set the owning side to null (unless already changed)
            if ($sousmission->getEvennement() === $this) {
                $sousmission->setEvennement(null);
            }
        }

        return $this;
    }

    

  
}

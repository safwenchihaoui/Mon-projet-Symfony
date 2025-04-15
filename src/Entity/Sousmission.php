<?php

namespace App\Entity;

use App\Repository\SousmissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SousmissionRepository::class)]
class Sousmission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Type('string')]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    
    private ?string $fichier = null;

 

    #[ORM\ManyToOne(inversedBy: 'sousmissions')]
    private ?Evennement $Evennement = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $Nom_auteur_correspond = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom_auteur_correspond = null;

     #[ORM\Column(length: 255)]
     #[Assert\NotBlank(message: 'Veuillez entrer un email.')]
     #[Assert\Email( message: 'The email {{ value }} is not a valid email.',)]
     
     
    private ?string $Email_auteur_correspond = null;

    #[ORM\Column(length: 255)]
    private ?string $theme ;

   

    #[ORM\Column(length: 255,nullable:true)]
    private ?string $resume = null;

    /**
     * @var Collection<int, Auteur>
     */
    #[ORM\OneToMany(targetEntity: Auteur::class, mappedBy: 'Sousmission',cascade: ['persist'])]
    

  
    private Collection $auteurs;

    
    #[ORM\Column(type: 'datetime')]
private ?\DateTimeInterface $date = null;


    public function __construct()
    {
        $this->auteurs = new ArrayCollection();
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

  
    
    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(string $fichier): static
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getEvennement(): ?Evennement
    {
        return $this->Evennement;
    }

    public function setEvennement(?Evennement $Evennement): static
    {
        $this->Evennement = $Evennement;

        return $this;
    }

    public function getNomAuteurCorrespond(): ?string
    {
        return $this->Nom_auteur_correspond;
    }

    public function setNomAuteurCorrespond(string $Nom_auteur_correspond): static
    {
        $this->Nom_auteur_correspond = $Nom_auteur_correspond;

        return $this;
    }

    public function getPrenomAuteurCorrespond(): ?string
    {
        return $this->Prenom_auteur_correspond;
    }

    public function setPrenomAuteurCorrespond(string $Prenom_auteur_correspond): static
    {
        $this->Prenom_auteur_correspond = $Prenom_auteur_correspond;

        return $this;
    }

    public function getEmailAuteurCorrespond(): ?string
    {
        return $this->Email_auteur_correspond;
    }

    public function setEmailAuteurCorrespond(string $Email_auteur_correspond): static
    {
        $this->Email_auteur_correspond = $Email_auteur_correspond;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * @return Collection<int, Auteur>
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }
    
    
    public function addAuteur(Auteur $auteur): static
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs[] = $auteur;
            $auteur->setSousmission($this);
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): static
    {
        if ($this->auteurs->removeElement($auteur)) {
            // set the owning side to null (unless already changed)
            if ($auteur->getSousmission() === $this) {
                $auteur->setSousmission(null);
            }
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}
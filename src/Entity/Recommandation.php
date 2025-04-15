<?php

namespace App\Entity;

use App\Repository\RecommandationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecommandationRepository::class)]
class Recommandation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;
    private $CategorieRecommand;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;
    

    #[ORM\Column(length: 255)]
    private ?string $image = "";

    #[ORM\Column(length: 255)]
    private ?string $pdf = "";

    #[ORM\Column(length: 255)]
    private ?string $lien = "";

    #[ORM\ManyToOne(targetEntity: SouscategorieRecommand::class ,inversedBy: 'recommandations')]
    private ?SouscategorieRecommand $SouscategorieRecommand;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(string $pdf): static
    {
        $this->pdf = $pdf;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): static
    {
        $this->lien = $lien;

        return $this;
    }

    public function getSouscategorieRecommand(): ?SouscategorieRecommand
    {
        return $this->SouscategorieRecommand;
    }

    public function setSouscategorieRecommand(?SouscategorieRecommand $SouscategorieRecommand): static
    {
        $this->SouscategorieRecommand = $SouscategorieRecommand;

        return $this;
    }
    public function getCategorieRecommand()
{
    return $this->CategorieRecommand;
}

public function setCategorieRecommand($CategorieRecommand)
{
    $this->CategorieRecommand = $CategorieRecommand;
}
}

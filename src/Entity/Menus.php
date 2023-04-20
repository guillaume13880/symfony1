<?php

namespace App\Entity;

use App\Repository\MenusRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MenusRepository::class)]
#[UniqueEntity('titre')]
class Menus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(min: 2, max: 30)]
    #[Assert\NotBlank()]
    private ?string $titre = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(min: 2, max: 30)]
    #[Assert\NotBlank()]
    private ?string $formule1 = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 2, max: 50)]
    #[Assert\NotBlank()]
    private ?string $description1 = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\LessThan(200)]
    #[Assert\NotNull()]
    private ?float $prix1 = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(min: 2, max: 30)]
    #[Assert\NotBlank()]
    private ?string $formule2 = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 2, max: 50)]
    #[Assert\NotBlank()]
    private ?string $description2 = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\LessThan(200)]
    #[Assert\NotNull()]
    private ?float $prix2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getFormule1(): ?string
    {
        return $this->formule1;
    }

    public function setFormule1(string $formule1): self
    {
        $this->formule1 = $formule1;

        return $this;
    }

    public function getDescription1(): ?string
    {
        return $this->description1;
    }

    public function setDescription1(string $description1): self
    {
        $this->description1 = $description1;

        return $this;
    }

    public function getPrix1(): ?float
    {
        return $this->prix1;
    }

    public function setPrix1(float $prix1): self
    {
        $this->prix1 = $prix1;

        return $this;
    }

    public function getFormule2(): ?string
    {
        return $this->formule2;
    }

    public function setFormule2(string $formule2): self
    {
        $this->formule2 = $formule2;

        return $this;
    }

    public function getDescription2(): ?string
    {
        return $this->description2;
    }

    public function setDescription2(string $description2): self
    {
        $this->description2 = $description2;

        return $this;
    }

    public function getPrix2(): ?float
    {
        return $this->prix2;
    }

    public function setPrix2(float $prix2): self
    {
        $this->prix2 = $prix2;

        return $this;
    }
}

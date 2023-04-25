<?php

namespace App\Entity;

use App\Repository\HorairesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HorairesRepository::class)]
class Horaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $luAM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $luPM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $maAM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $maPM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $meAM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $mePM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $jeAM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $jePM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $veAM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $vePM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $saAM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $saPM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $diAM = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $diPM = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLuAM(): ?string
    {
        return $this->luAM;
    }

    public function setLuAM(string $luAM): self
    {
        $this->luAM = $luAM;

        return $this;
    }

    public function getLuPM(): ?string
    {
        return $this->luPM;
    }

    public function setLuPM(string $luPM): self
    {
        $this->luPM = $luPM;

        return $this;
    }

    public function getMaAM(): ?string
    {
        return $this->maAM;
    }

    public function setMaAM(string $maAM): self
    {
        $this->maAM = $maAM;

        return $this;
    }

    public function getMaPM(): ?string
    {
        return $this->maPM;
    }

    public function setMaPM(string $maPM): self
    {
        $this->maPM = $maPM;

        return $this;
    }

    public function getMeAM(): ?string
    {
        return $this->meAM;
    }

    public function setMeAM(string $meAM): self
    {
        $this->meAM = $meAM;

        return $this;
    }

    public function getMePM(): ?string
    {
        return $this->mePM;
    }

    public function setMePM(string $mePM): self
    {
        $this->mePM = $mePM;

        return $this;
    }

    public function getJeAM(): ?string
    {
        return $this->jeAM;
    }

    public function setJeAM(string $jeAM): self
    {
        $this->jeAM = $jeAM;

        return $this;
    }

    public function getJePM(): ?string
    {
        return $this->jePM;
    }

    public function setJePM(string $jePM): self
    {
        $this->jePM = $jePM;

        return $this;
    }

    public function getVeAM(): ?string
    {
        return $this->veAM;
    }

    public function setVeAM(string $veAM): self
    {
        $this->veAM = $veAM;

        return $this;
    }

    public function getVePM(): ?string
    {
        return $this->vePM;
    }

    public function setVePM(string $vePM): self
    {
        $this->vePM = $vePM;

        return $this;
    }

    public function getSaAM(): ?string
    {
        return $this->saAM;
    }

    public function setSaAM(string $saAM): self
    {
        $this->saAM = $saAM;

        return $this;
    }

    public function getSaPM(): ?string
    {
        return $this->saPM;
    }

    public function setSaPM(string $saPM): self
    {
        $this->saPM = $saPM;

        return $this;
    }

    public function getDiAM(): ?string
    {
        return $this->diAM;
    }

    public function setDiAM(string $diAM): self
    {
        $this->diAM = $diAM;

        return $this;
    }

    public function getDiPM(): ?string
    {
        return $this->diPM;
    }

    public function setDiPM(string $diPM): self
    {
        $this->diPM = $diPM;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\NpcsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NpcsRepository::class)]
class Npcs extends ActorProtagonista
{
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $profesion = null;

    #[ORM\Column]
    private ?bool $descubierto = null;

    #[ORM\Column]
    private ?bool $hostil = null;

    public function getProfesion(): ?string
    {
        return $this->profesion;
    }

    public function setProfesion(?string $profesion): static
    {
        $this->profesion = $profesion;

        return $this;
    }

    public function isDescubierto(): ?bool
    {
        return $this->descubierto;
    }

    public function setDescubierto(bool $descubierto): static
    {
        $this->descubierto = $descubierto;

        return $this;
    }

    public function isHostil(): ?bool
    {
        return $this->hostil;
    }

    public function setHostil(bool $hostil): static
    {
        $this->hostil = $hostil;

        return $this;
    }
}

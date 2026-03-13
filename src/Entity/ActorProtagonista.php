<?php

namespace App\Entity;

use App\Repository\ActorProtagonistaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class ActorProtagonista extends Actor
{
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $alineamiento = null;

    #[ORM\Column(nullable: true)]
    private ?int $oro = null;

    #[ORM\ManyToOne(inversedBy: 'actorProtagonistas')]
    private ?Lugares $lugar = null;

    #[ORM\ManyToOne(inversedBy: 'actorProtagonistas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genero $genero = null;

    #[ORM\ManyToOne(inversedBy: 'actorProtagonistas')]
    private ?Estado $estado = null;

    public function getAlineamiento(): ?string
    {
        return $this->alineamiento;
    }

    public function setAlineamiento(?string $alineamiento): static
    {
        $this->alineamiento = $alineamiento;

        return $this;
    }

    public function getOro(): ?int
    {
        return $this->oro;
    }

    public function setOro(?int $oro): static
    {
        $this->oro = $oro;

        return $this;
    }

    public function getLugar(): ?Lugares
    {
        return $this->lugar;
    }

    public function setLugar(?Lugares $lugar): static
    {
        $this->lugar = $lugar;

        return $this;
    }

    public function getGenero(): ?Genero
    {
        return $this->genero;
    }

    public function setGenero(?Genero $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): static
    {
        $this->estado = $estado;

        return $this;
    }
}

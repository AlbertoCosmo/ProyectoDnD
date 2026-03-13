<?php

namespace App\Entity\EntidadesPrueba;

use App\Repository\CapitulosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

class Capitulos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $resumen = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $resumenCompleto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getResumen(): ?string
    {
        return $this->resumen;
    }

    public function setResumen(?string $resumen): static
    {
        $this->resumen = $resumen;

        return $this;
    }

    public function getResumenCompleto(): ?string
    {
        return $this->resumenCompleto;
    }

    public function setResumenCompleto(?string $resumenCompleto): static
    {
        $this->resumenCompleto = $resumenCompleto;

        return $this;
    }
}

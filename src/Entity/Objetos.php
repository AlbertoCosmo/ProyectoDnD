<?php

namespace App\Entity;

use App\Repository\ObjetosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjetosRepository::class)]
class Objetos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $peso = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $precio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $magico = null;

    #[ORM\Column(nullable: true)]
    private ?bool $unico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(?string $peso): static
    {
        $this->peso = $peso;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(?string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function isMagico(): ?bool
    {
        return $this->magico;
    }

    public function setMagico(?bool $magico): static
    {
        $this->magico = $magico;

        return $this;
    }

    public function isUnico(): ?bool
    {
        return $this->unico;
    }

    public function setUnico(?bool $unico): static
    {
        $this->unico = $unico;

        return $this;
    }
}

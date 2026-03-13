<?php

namespace App\Entity;

use App\Repository\OfertaComercialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfertaComercialRepository::class)]
class OfertaComercial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ofertaComercials')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Npcs $vendedor = null;

    #[ORM\ManyToOne(inversedBy: 'ofertaComercials')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Objetos $objeto = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column]
    private ?int $precioLocal = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $rebaja = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVendedor(): ?Npcs
    {
        return $this->vendedor;
    }

    public function setVendedor(?Npcs $vendedor): static
    {
        $this->vendedor = $vendedor;

        return $this;
    }

    public function getObjeto(): ?Objetos
    {
        return $this->objeto;
    }

    public function setObjeto(?Objetos $objeto): static
    {
        $this->objeto = $objeto;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrecioLocal(): ?int
    {
        return $this->precioLocal;
    }

    public function setPrecioLocal(int $precioLocal): static
    {
        $this->precioLocal = $precioLocal;

        return $this;
    }

    public function getRebaja(): ?string
    {
        return $this->rebaja;
    }

    public function setRebaja(?string $rebaja): static
    {
        $this->rebaja = $rebaja;

        return $this;
    }
}

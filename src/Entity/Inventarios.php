<?php

namespace App\Entity;

use App\Repository\InventariosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InventariosRepository::class)]
class Inventarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'inventarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personajes $personaje = null;

    #[ORM\ManyToOne(inversedBy: 'inventarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Objetos $objeto = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonaje(): ?Personajes
    {
        return $this->personaje;
    }

    public function setPersonaje(?Personajes $personaje): static
    {
        $this->personaje = $personaje;

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

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}

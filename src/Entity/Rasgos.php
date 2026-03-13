<?php

namespace App\Entity;

use App\Repository\RasgosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RasgosRepository::class)]
class Rasgos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Razas>
     */
    #[ORM\ManyToMany(targetEntity: Razas::class, mappedBy: 'rasgos')]
    private Collection $razas;

    public function __construct()
    {
        $this->razas = new ArrayCollection();
    }

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Razas>
     */
    public function getRazas(): Collection
    {
        return $this->razas;
    }

    public function addRaza(Razas $raza): static
    {
        if (!$this->razas->contains($raza)) {
            $this->razas->add($raza);
            $raza->addRasgo($this);
        }

        return $this;
    }

    public function removeRaza(Razas $raza): static
    {
        if ($this->razas->removeElement($raza)) {
            $raza->removeRasgo($this);
        }

        return $this;
    }
}

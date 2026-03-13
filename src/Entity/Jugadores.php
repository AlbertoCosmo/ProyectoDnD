<?php

namespace App\Entity;

use App\Repository\JugadoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JugadoresRepository::class)]
class Jugadores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $apellido = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(nullable: true)]
    private ?int $edad = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $apodo = null;

    /**
     * @var Collection<int, Personajes>
     */
    #[ORM\OneToMany(targetEntity: Personajes::class, mappedBy: 'jugador')]
    private Collection $personajes;

    public function __construct()
    {
        $this->personajes = new ArrayCollection();
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

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): static
    {
        $this->edad = $edad;

        return $this;
    }

    public function getApodo(): ?string
    {
        return $this->apodo;
    }

    public function setApodo(?string $apodo): static
    {
        $this->apodo = $apodo;

        return $this;
    }

    /**
     * @return Collection<int, Personajes>
     */
    public function getPersonajes(): Collection
    {
        return $this->personajes;
    }

    public function addPersonaje(Personajes $personaje): static
    {
        if (!$this->personajes->contains($personaje)) {
            $this->personajes->add($personaje);
            $personaje->setJugador($this);
        }

        return $this;
    }

    public function removePersonaje(Personajes $personaje): static
    {
        if ($this->personajes->removeElement($personaje)) {
            // set the owning side to null (unless already changed)
            if ($personaje->getJugador() === $this) {
                $personaje->setJugador(null);
            }
        }

        return $this;
    }
}

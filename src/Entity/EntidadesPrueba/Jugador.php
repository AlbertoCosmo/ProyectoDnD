<?php

namespace App\Entity\EntidadesPrueba;

use App\Repository\JugadorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class Jugador
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column]
    private ?int $Edad = null;

    #[ORM\Column(length: 255)]
    private ?string $Lugar = null;

    #[ORM\Column]
    private ?bool $Master = null;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\OneToMany(targetEntity: Personaje::class, mappedBy: 'Jugador')]
    private Collection $personajes;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Apellido = null;

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
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->Edad;
    }

    public function setEdad(int $Edad): static
    {
        $this->Edad = $Edad;

        return $this;
    }

    public function getLugar(): ?string
    {
        return $this->Lugar;
    }

    public function setLugar(string $Lugar): static
    {
        $this->Lugar = $Lugar;

        return $this;
    }

    public function isMaster(): ?bool
    {
        return $this->Master;
    }

    public function setMaster(bool $Master): static
    {
        $this->Master = $Master;

        return $this;
    }

    /**
     * @return Collection<int, Personaje>
     */
    public function getPersonajes(): Collection
    {
        return $this->personajes;
    }

    public function addPersonaje(Personaje $personaje): static
    {
        if (!$this->personajes->contains($personaje)) {
            $this->personajes->add($personaje);
            $personaje->setJugador($this);
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): static
    {
        if ($this->personajes->removeElement($personaje)) {
            // set the owning side to null (unless already changed)
            if ($personaje->getJugador() === $this) {
                $personaje->setJugador(null);
            }
        }

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->Apellido;
    }

    public function setApellido(?string $Apellido): static
    {
        $this->Apellido = $Apellido;

        return $this;
    }
}

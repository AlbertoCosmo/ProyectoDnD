<?php

namespace App\Entity;

use App\Repository\PersonajesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonajesRepository::class)]
class Personajes extends ActorProtagonista
{
    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?Jugadores $jugador = null;

    /**
     * @var Collection<int, Inventarios>
     */
    #[ORM\OneToMany(targetEntity: Inventarios::class, mappedBy: 'personaje')]
    private Collection $inventarios;

    public function __construct()
    {
        $this->inventarios = new ArrayCollection();
    }

    public function getJugador(): ?Jugadores
    {
        return $this->jugador;
    }

    public function setJugador(?Jugadores $jugador): static
    {
        $this->jugador = $jugador;

        return $this;
    }

    /**
     * @return Collection<int, Inventarios>
     */
    public function getInventarios(): Collection
    {
        return $this->inventarios;
    }

    public function addInventario(Inventarios $inventario): static
    {
        if (!$this->inventarios->contains($inventario)) {
            $this->inventarios->add($inventario);
            $inventario->setPersonaje($this);
        }

        return $this;
    }

    public function removeInventario(Inventarios $inventario): static
    {
        if ($this->inventarios->removeElement($inventario)) {
            // set the owning side to null (unless already changed)
            if ($inventario->getPersonaje() === $this) {
                $inventario->setPersonaje(null);
            }
        }

        return $this;
    }
}

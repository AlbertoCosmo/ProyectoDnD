<?php

namespace App\Entity;

use App\Repository\PersonajesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonajesRepository::class)]
class Personajes extends ActorProtagonista
{
    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?Jugadores $jugador = null;

    public function getJugador(): ?Jugadores
    {
        return $this->jugador;
    }

    public function setJugador(?Jugadores $jugador): static
    {
        $this->jugador = $jugador;

        return $this;
    }
}

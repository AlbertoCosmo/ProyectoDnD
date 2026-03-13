<?php

namespace App\Entity\EntidadesPrueba;

use App\Repository\PersonajeRepository;
use Doctrine\ORM\Mapping as ORM;

class Personaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(nullable: true)]
    private ?int $Edad = null;

    #[ORM\Column]
    private ?bool $Vivo = null;

    #[ORM\Column(length: 1)]
    private ?string $Genero = null;

    #[ORM\Column(nullable: true)]
    private ?int $StatsPj = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    #[ORM\JoinColumn(name: "jugador_id", referencedColumnName: "id", nullable: false)]
    private ?Jugador $Jugador = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clase $Clase = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Raza $Raza = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?Lugares $Lugar = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

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

    public function getEdad(): ?int
    {
        return $this->Edad;
    }

    public function setEdad(?int $Edad): static
    {
        $this->Edad = $Edad;

        return $this;
    }

    public function isVivo(): ?bool
    {
        return $this->Vivo;
    }

    public function setVivo(bool $Vivo): static
    {
        $this->Vivo = $Vivo;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->Genero;
    }

    public function setGenero(string $Genero): static
    {
        $this->Genero = $Genero;

        return $this;
    }

    public function getStatsPj(): ?int
    {
        return $this->StatsPj;
    }

    public function setStatsPj(?int $StatsPj): static
    {
        $this->StatsPj = $StatsPj;

        return $this;
    }

    public function getJugador(): ?Jugador
    {
        return $this->Jugador;
    }

    public function setJugador(?Jugador $Jugador): static
    {
        $this->Jugador = $Jugador;

        return $this;
    }

    public function getClase(): ?Clase
    {
        return $this->Clase;
    }

    public function setClase(?Clase $Clase): static
    {
        $this->Clase = $Clase;

        return $this;
    }

    public function getRaza(): ?Raza
    {
        return $this->Raza;
    }

    public function setRaza(?Raza $Raza): static
    {
        $this->Raza = $Raza;

        return $this;
    }

    public function getLugar(): ?Lugares
    {
        return $this->Lugar;
    }

    public function setLugar(?Lugares $Lugar): static
    {
        $this->Lugar = $Lugar;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): static
    {
        $this->token = $token;

        return $this;
    }
}

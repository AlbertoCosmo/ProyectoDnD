<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'tipo', type: 'string')]
#[ORM\DiscriminatorMap([
    'personaje' => Personajes::class, 
    'npc' => Npcs::class, 
    'enemigo' => Enemigos::class
])]
abstract class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $edad = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $peso = null;

    #[ORM\Column(nullable: true)]
    private ?int $nivel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\ManyToOne(inversedBy: 'actors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clases $clase = null;

    #[ORM\ManyToOne(inversedBy: 'actors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Razas $raza = null;

    #[ORM\OneToOne(inversedBy: 'actor', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Estadisticas $estadisticas = null;

    #[ORM\ManyToOne(inversedBy: 'actors')]
    private ?Subclase $subclase = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEdad(): ?string
    {
        return $this->edad;
    }

    public function setEdad(?string $edad): static
    {
        $this->edad = $edad;

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

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(?int $nivel): static
    {
        $this->nivel = $nivel;

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

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getClase(): ?Clases
    {
        return $this->clase;
    }

    public function setClase(?Clases $clase): static
    {
        $this->clase = $clase;

        return $this;
    }

    public function getRaza(): ?Razas
    {
        return $this->raza;
    }

    public function setRaza(?Razas $raza): static
    {
        $this->raza = $raza;

        return $this;
    }

    public function getEstadisticas(): ?Estadisticas
    {
        return $this->estadisticas;
    }

    public function setEstadisticas(Estadisticas $estadisticas): static
    {
        $this->estadisticas = $estadisticas;

        return $this;
    }

    public function getSubclase(): ?Subclase
    {
        return $this->subclase;
    }

    public function setSubclase(?Subclase $subclase): static
    {
        $this->subclase = $subclase;

        return $this;
    }
}

<?php

namespace App\Entity\EntidadesPrueba;

use App\Repository\NpcRepository;
use Doctrine\ORM\Mapping as ORM;

class Npc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\ManyToOne(inversedBy: 'npcs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lugares $Lugar = null;

    #[ORM\ManyToOne(inversedBy: 'npcs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Raza $Raza = null;

    #[ORM\ManyToOne(inversedBy: 'npcs')]
    private ?Clase $Clase = null;

    #[ORM\Column]
    private ?bool $Vivo = null;

    #[ORM\Column]
    private ?bool $Amistoso = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Descripcion = null;

    #[ORM\Column]
    private ?bool $Comerciante = null;

    #[ORM\Column(nullable: true)]
    private ?int $Edad = null;

    #[ORM\Column(length: 1)]
    private ?string $Genero = null;

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
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

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

    public function getRaza(): ?Raza
    {
        return $this->Raza;
    }

    public function setRaza(?Raza $Raza): static
    {
        $this->Raza = $Raza;

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

    public function isVivo(): ?bool
    {
        return $this->Vivo;
    }

    public function setVivo(bool $Vivo): static
    {
        $this->Vivo = $Vivo;

        return $this;
    }

    public function isAmistoso(): ?bool
    {
        return $this->Amistoso;
    }

    public function setAmistoso(bool $Amistoso): static
    {
        $this->Amistoso = $Amistoso;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(?string $Descripcion): static
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function isComerciante(): ?bool
    {
        return $this->Comerciante;
    }

    public function setComerciante(bool $Comerciante): static
    {
        $this->Comerciante = $Comerciante;

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

    public function getGenero(): ?string
    {
        return $this->Genero;
    }

    public function setGenero(string $Genero): static
    {
        $this->Genero = $Genero;

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

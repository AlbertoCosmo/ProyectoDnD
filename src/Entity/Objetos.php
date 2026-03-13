<?php

namespace App\Entity;

use App\Repository\ObjetosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjetosRepository::class)]
class Objetos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $peso = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $precio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $magico = null;

    #[ORM\Column(nullable: true)]
    private ?bool $unico = null;

    /**
     * @var Collection<int, Inventarios>
     */
    #[ORM\OneToMany(targetEntity: Inventarios::class, mappedBy: 'objeto', orphanRemoval: true)]
    private Collection $inventarios;

    /**
     * @var Collection<int, OfertaComercial>
     */
    #[ORM\OneToMany(targetEntity: OfertaComercial::class, mappedBy: 'objeto', orphanRemoval: true)]
    private Collection $ofertaComercials;

    public function __construct()
    {
        $this->inventarios = new ArrayCollection();
        $this->ofertaComercials = new ArrayCollection();
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

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(?string $peso): static
    {
        $this->peso = $peso;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(?string $precio): static
    {
        $this->precio = $precio;

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

    public function isMagico(): ?bool
    {
        return $this->magico;
    }

    public function setMagico(?bool $magico): static
    {
        $this->magico = $magico;

        return $this;
    }

    public function isUnico(): ?bool
    {
        return $this->unico;
    }

    public function setUnico(?bool $unico): static
    {
        $this->unico = $unico;

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
            $inventario->setObjeto($this);
        }

        return $this;
    }

    public function removeInventario(Inventarios $inventario): static
    {
        if ($this->inventarios->removeElement($inventario)) {
            // set the owning side to null (unless already changed)
            if ($inventario->getObjeto() === $this) {
                $inventario->setObjeto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OfertaComercial>
     */
    public function getOfertaComercials(): Collection
    {
        return $this->ofertaComercials;
    }

    public function addOfertaComercial(OfertaComercial $ofertaComercial): static
    {
        if (!$this->ofertaComercials->contains($ofertaComercial)) {
            $this->ofertaComercials->add($ofertaComercial);
            $ofertaComercial->setObjeto($this);
        }

        return $this;
    }

    public function removeOfertaComercial(OfertaComercial $ofertaComercial): static
    {
        if ($this->ofertaComercials->removeElement($ofertaComercial)) {
            // set the owning side to null (unless already changed)
            if ($ofertaComercial->getObjeto() === $this) {
                $ofertaComercial->setObjeto(null);
            }
        }

        return $this;
    }
}

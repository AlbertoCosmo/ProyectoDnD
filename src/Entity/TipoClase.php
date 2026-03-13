<?php

namespace App\Entity;

use App\Repository\TipoClaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoClaseRepository::class)]
class TipoClase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Clases>
     */
    #[ORM\OneToMany(targetEntity: Clases::class, mappedBy: 'tipoClase', orphanRemoval: true)]
    private Collection $clases;

    /**
     * @var Collection<int, Subclase>
     */
    #[ORM\OneToMany(targetEntity: Subclase::class, mappedBy: 'tipo', orphanRemoval: true)]
    private Collection $subclases;

    public function __construct()
    {
        $this->clases = new ArrayCollection();
        $this->subclases = new ArrayCollection();
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
     * @return Collection<int, Clases>
     */
    public function getClases(): Collection
    {
        return $this->clases;
    }

    public function addClase(Clases $clase): static
    {
        if (!$this->clases->contains($clase)) {
            $this->clases->add($clase);
            $clase->setTipoClase($this);
        }

        return $this;
    }

    public function removeClase(Clases $clase): static
    {
        if ($this->clases->removeElement($clase)) {
            // set the owning side to null (unless already changed)
            if ($clase->getTipoClase() === $this) {
                $clase->setTipoClase(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subclase>
     */
    public function getSubclases(): Collection
    {
        return $this->subclases;
    }

    public function addSubclase(Subclase $subclase): static
    {
        if (!$this->subclases->contains($subclase)) {
            $this->subclases->add($subclase);
            $subclase->setTipo($this);
        }

        return $this;
    }

    public function removeSubclase(Subclase $subclase): static
    {
        if ($this->subclases->removeElement($subclase)) {
            // set the owning side to null (unless already changed)
            if ($subclase->getTipo() === $this) {
                $subclase->setTipo(null);
            }
        }

        return $this;
    }
}

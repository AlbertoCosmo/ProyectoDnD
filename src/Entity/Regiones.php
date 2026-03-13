<?php

namespace App\Entity;

use App\Repository\RegionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionesRepository::class)]
class Regiones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gobierno = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $alineamiento = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Lugares>
     */
    #[ORM\OneToMany(targetEntity: Lugares::class, mappedBy: 'region', orphanRemoval: true)]
    private Collection $lugares;

    public function __construct()
    {
        $this->lugares = new ArrayCollection();
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

    public function getGobierno(): ?string
    {
        return $this->gobierno;
    }

    public function setGobierno(?string $gobierno): static
    {
        $this->gobierno = $gobierno;

        return $this;
    }

    public function getAlineamiento(): ?string
    {
        return $this->alineamiento;
    }

    public function setAlineamiento(?string $alineamiento): static
    {
        $this->alineamiento = $alineamiento;

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
     * @return Collection<int, Lugares>
     */
    public function getLugares(): Collection
    {
        return $this->lugares;
    }

    public function addLugare(Lugares $lugare): static
    {
        if (!$this->lugares->contains($lugare)) {
            $this->lugares->add($lugare);
            $lugare->setRegion($this);
        }

        return $this;
    }

    public function removeLugare(Lugares $lugare): static
    {
        if ($this->lugares->removeElement($lugare)) {
            // set the owning side to null (unless already changed)
            if ($lugare->getRegion() === $this) {
                $lugare->setRegion(null);
            }
        }

        return $this;
    }
}

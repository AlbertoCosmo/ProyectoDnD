<?php

namespace App\Entity;

use App\Repository\NpcsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NpcsRepository::class)]
class Npcs extends ActorProtagonista
{
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $profesion = null;

    #[ORM\Column]
    private ?bool $descubierto = null;

    #[ORM\Column]
    private ?bool $hostil = null;

    /**
     * @var Collection<int, OfertaComercial>
     */
    #[ORM\OneToMany(targetEntity: OfertaComercial::class, mappedBy: 'vendedor')]
    private Collection $ofertaComercials;

    public function __construct()
    {
        $this->ofertaComercials = new ArrayCollection();
    }

    public function getProfesion(): ?string
    {
        return $this->profesion;
    }

    public function setProfesion(?string $profesion): static
    {
        $this->profesion = $profesion;

        return $this;
    }

    public function isDescubierto(): ?bool
    {
        return $this->descubierto;
    }

    public function setDescubierto(bool $descubierto): static
    {
        $this->descubierto = $descubierto;

        return $this;
    }

    public function isHostil(): ?bool
    {
        return $this->hostil;
    }

    public function setHostil(bool $hostil): static
    {
        $this->hostil = $hostil;

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
            $ofertaComercial->setVendedor($this);
        }

        return $this;
    }

    public function removeOfertaComercial(OfertaComercial $ofertaComercial): static
    {
        if ($this->ofertaComercials->removeElement($ofertaComercial)) {
            // set the owning side to null (unless already changed)
            if ($ofertaComercial->getVendedor() === $this) {
                $ofertaComercial->setVendedor(null);
            }
        }

        return $this;
    }
}

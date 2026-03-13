<?php

namespace App\Entity;

use App\Repository\ClasesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasesRepository::class)]
class Clases
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripci�on = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\ManyToOne(inversedBy: 'clases')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TipoClase $tipoClase = null;

    /**
     * @var Collection<int, Subclase>
     */
    #[ORM\OneToMany(targetEntity: Subclase::class, mappedBy: 'clase', orphanRemoval: true)]
    private Collection $subclases;

    /**
     * @var Collection<int, Actor>
     */
    #[ORM\OneToMany(targetEntity: Actor::class, mappedBy: 'clase')]
    private Collection $actors;

    public function __construct()
    {
        $this->subclases = new ArrayCollection();
        $this->actors = new ArrayCollection();
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

    public function getDescripci�on(): ?string
    {
        return $this->descripci�on;
    }

    public function setDescripci�on(?string $descripci�on): static
    {
        $this->descripci�on = $descripci�on;

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

    public function getTipoClase(): ?TipoClase
    {
        return $this->tipoClase;
    }

    public function setTipoClase(?TipoClase $tipoClase): static
    {
        $this->tipoClase = $tipoClase;

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
            $subclase->setClase($this);
        }

        return $this;
    }

    public function removeSubclase(Subclase $subclase): static
    {
        if ($this->subclases->removeElement($subclase)) {
            // set the owning side to null (unless already changed)
            if ($subclase->getClase() === $this) {
                $subclase->setClase(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): static
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
            $actor->setClase($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        if ($this->actors->removeElement($actor)) {
            // set the owning side to null (unless already changed)
            if ($actor->getClase() === $this) {
                $actor->setClase(null);
            }
        }

        return $this;
    }
}

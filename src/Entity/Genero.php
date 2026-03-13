<?php

namespace App\Entity;

use App\Repository\GeneroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneroRepository::class)]
class Genero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Actor>
     */
    #[ORM\OneToMany(targetEntity: Actor::class, mappedBy: 'genero')]
    private Collection $actors;

    /**
     * @var Collection<int, ActorProtagonista>
     */
    #[ORM\OneToMany(targetEntity: ActorProtagonista::class, mappedBy: 'genero', orphanRemoval: true)]
    private Collection $actorProtagonistas;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->actorProtagonistas = new ArrayCollection();
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
     * @return Collection<int, ActorProtagonista>
     */
    public function getActorProtagonistas(): Collection
    {
        return $this->actorProtagonistas;
    }

    public function addActorProtagonista(ActorProtagonista $actorProtagonista): static
    {
        if (!$this->actorProtagonistas->contains($actorProtagonista)) {
            $this->actorProtagonistas->add($actorProtagonista);
            $actorProtagonista->setGenero($this);
        }

        return $this;
    }

    public function removeActorProtagonista(ActorProtagonista $actorProtagonista): static
    {
        if ($this->actorProtagonistas->removeElement($actorProtagonista)) {
            // set the owning side to null (unless already changed)
            if ($actorProtagonista->getGenero() === $this) {
                $actorProtagonista->setGenero(null);
            }
        }

        return $this;
    }
}

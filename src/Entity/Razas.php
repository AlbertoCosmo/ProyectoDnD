<?php

namespace App\Entity;

use App\Repository\RazasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RazasRepository::class)]
class Razas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'razas')]
    private ?Origenes $origen = null;

    /**
     * @var Collection<int, Rasgos>
     */
    #[ORM\ManyToMany(targetEntity: Rasgos::class, inversedBy: 'razas')]
    private Collection $rasgos;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    /**
     * @var Collection<int, Actor>
     */
    #[ORM\OneToMany(targetEntity: Actor::class, mappedBy: 'raza', orphanRemoval: true)]
    private Collection $actors;

    public function __construct()
    {
        $this->rasgos = new ArrayCollection();
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

    public function getOrigen(): ?Origenes
    {
        return $this->origen;
    }

    public function setOrigen(?Origenes $origen): static
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * @return Collection<int, Rasgos>
     */
    public function getRasgos(): Collection
    {
        return $this->rasgos;
    }

    public function addRasgo(Rasgos $rasgo): static
    {
        if (!$this->rasgos->contains($rasgo)) {
            $this->rasgos->add($rasgo);
        }

        return $this;
    }

    public function removeRasgo(Rasgos $rasgo): static
    {
        $this->rasgos->removeElement($rasgo);

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
            $actor->setRaza($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        if ($this->actors->removeElement($actor)) {
            // set the owning side to null (unless already changed)
            if ($actor->getRaza() === $this) {
                $actor->setRaza(null);
            }
        }

        return $this;
    }
}

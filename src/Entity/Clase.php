<?php

namespace App\Entity;

use App\Repository\ClaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClaseRepository::class)]
class Clase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl5 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl6 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl7 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl8 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl9 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Lvl10 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Descripcion = null;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\OneToMany(targetEntity: Personaje::class, mappedBy: 'Clase')]
    private Collection $personajes;

    /**
     * @var Collection<int, Npc>
     */
    #[ORM\OneToMany(targetEntity: Npc::class, mappedBy: 'Clase')]
    private Collection $npcs;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    public function __construct()
    {
        $this->personajes = new ArrayCollection();
        $this->npcs = new ArrayCollection();
    }


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

    public function getLvl1(): ?string
    {
        return $this->Lvl1;
    }

    public function setLvl1(?string $Lvl1): static
    {
        $this->Lvl1 = $Lvl1;

        return $this;
    }

    public function getLvl2(): ?string
    {
        return $this->Lvl2;
    }

    public function setLvl2(?string $Lvl2): static
    {
        $this->Lvl2 = $Lvl2;

        return $this;
    }

    public function getLvl3(): ?string
    {
        return $this->Lvl3;
    }

    public function setLvl3(?string $Lvl3): static
    {
        $this->Lvl3 = $Lvl3;

        return $this;
    }

    public function getLvl4(): ?string
    {
        return $this->Lvl4;
    }

    public function setLvl4(?string $Lvl4): static
    {
        $this->Lvl4 = $Lvl4;

        return $this;
    }

    public function getLvl5(): ?string
    {
        return $this->Lvl5;
    }

    public function setLvl5(?string $Lvl5): static
    {
        $this->Lvl5 = $Lvl5;

        return $this;
    }

    public function getLvl6(): ?string
    {
        return $this->Lvl6;
    }

    public function setLvl6(?string $Lvl6): static
    {
        $this->Lvl6 = $Lvl6;

        return $this;
    }

    public function getLvl7(): ?string
    {
        return $this->Lvl7;
    }

    public function setLvl7(?string $Lvl7): static
    {
        $this->Lvl7 = $Lvl7;

        return $this;
    }

    public function getLvl8(): ?string
    {
        return $this->Lvl8;
    }

    public function setLvl8(?string $Lvl8): static
    {
        $this->Lvl8 = $Lvl8;

        return $this;
    }

    public function getLvl9(): ?string
    {
        return $this->Lvl9;
    }

    public function setLvl9(?string $Lvl9): static
    {
        $this->Lvl9 = $Lvl9;

        return $this;
    }

    public function getLvl10(): ?string
    {
        return $this->Lvl10;
    }

    public function setLvl10(?string $Lvl10): static
    {
        $this->Lvl10 = $Lvl10;

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

    /**
     * @return Collection<int, Personaje>
     */
    public function getPersonajes(): Collection
    {
        return $this->personajes;
    }

    public function addPersonaje(Personaje $personaje): static
    {
        if (!$this->personajes->contains($personaje)) {
            $this->personajes->add($personaje);
            $personaje->setClase($this);
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): static
    {
        if ($this->personajes->removeElement($personaje)) {
            // set the owning side to null (unless already changed)
            if ($personaje->getClase() === $this) {
                $personaje->setClase(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Npc>
     */
    public function getNpcs(): Collection
    {
        return $this->npcs;
    }

    public function addNpc(Npc $npc): static
    {
        if (!$this->npcs->contains($npc)) {
            $this->npcs->add($npc);
            $npc->setClase($this);
        }

        return $this;
    }

    public function removeNpc(Npc $npc): static
    {
        if ($this->npcs->removeElement($npc)) {
            // set the owning side to null (unless already changed)
            if ($npc->getClase() === $this) {
                $npc->setClase(null);
            }
        }

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

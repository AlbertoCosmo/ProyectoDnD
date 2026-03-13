<?php

namespace App\Entity;

use App\Repository\EstadisticasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstadisticasRepository::class)]
class Estadisticas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $fuerza = null;

    #[ORM\Column]
    private ?int $destreza = null;

    #[ORM\Column]
    private ?int $intelecto = null;

    #[ORM\Column]
    private ?int $constitucion = null;

    #[ORM\Column]
    private ?int $sabiduria = null;

    #[ORM\Column]
    private ?int $carisma = null;

    #[ORM\Column]
    private ?int $acrobacias = null;

    #[ORM\Column]
    private ?int $animalismo = null;

    #[ORM\Column]
    private ?int $atletismo = null;

    #[ORM\Column]
    private ?int $caos = null;

    #[ORM\Column]
    private ?int $conocimientoMagico = null;

    #[ORM\Column]
    private ?int $enganio = null;

    #[ORM\Column]
    private ?int $religion = null;

    #[ORM\Column]
    private ?int $historia = null;

    #[ORM\Column]
    private ?int $interpretacion = null;

    #[ORM\Column]
    private ?int $intimidacion = null;

    #[ORM\Column]
    private ?int $investigacion = null;

    #[ORM\Column]
    private ?int $juegoDeManos = null;

    #[ORM\Column]
    private ?int $medicina = null;

    #[ORM\Column]
    private ?int $naturaleza = null;

    #[ORM\Column]
    private ?int $orden = null;

    #[ORM\Column]
    private ?int $percepcion = null;

    #[ORM\Column]
    private ?int $perspicacia = null;

    #[ORM\Column]
    private ?int $persuasion = null;

    #[ORM\Column]
    private ?int $sigilo = null;

    #[ORM\Column]
    private ?int $supervivencia = null;

    #[ORM\Column(nullable: true)]
    private ?int $competencia = null;

    #[ORM\Column(nullable: true)]
    private ?int $vida = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $descanso = null;

    #[ORM\Column(nullable: true)]
    private ?int $mana = null;

    #[ORM\Column(nullable: true)]
    private ?int $energia = null;

    #[ORM\Column(nullable: true)]
    private ?int $furia = null;

    #[ORM\Column(nullable: true)]
    private ?int $movimiento = null;

    #[ORM\Column(nullable: true)]
    private ?int $armadura = null;

    #[ORM\Column(nullable: true)]
    private ?int $iniciativa = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $recursoEspecial = null;

    #[ORM\OneToOne(mappedBy: 'estadisticas', cascade: ['persist', 'remove'])]
    private ?Actor $actor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFuerza(): ?int
    {
        return $this->fuerza;
    }

    public function setFuerza(int $fuerza): static
    {
        $this->fuerza = $fuerza;

        return $this;
    }

    public function getDestreza(): ?int
    {
        return $this->destreza;
    }

    public function setDestreza(int $destreza): static
    {
        $this->destreza = $destreza;

        return $this;
    }

    public function getIntelecto(): ?int
    {
        return $this->intelecto;
    }

    public function setIntelecto(int $intelecto): static
    {
        $this->intelecto = $intelecto;

        return $this;
    }

    public function getConstitucion(): ?int
    {
        return $this->constitucion;
    }

    public function setConstitucion(int $constitucion): static
    {
        $this->constitucion = $constitucion;

        return $this;
    }

    public function getSabiduria(): ?int
    {
        return $this->sabiduria;
    }

    public function setSabiduria(int $sabiduria): static
    {
        $this->sabiduria = $sabiduria;

        return $this;
    }

    public function getCarisma(): ?int
    {
        return $this->carisma;
    }

    public function setCarisma(int $carisma): static
    {
        $this->carisma = $carisma;

        return $this;
    }

    public function getAcrobacias(): ?int
    {
        return $this->acrobacias;
    }

    public function setAcrobacias(int $acrobacias): static
    {
        $this->acrobacias = $acrobacias;

        return $this;
    }

    public function getAnimalismo(): ?int
    {
        return $this->animalismo;
    }

    public function setAnimalismo(int $animalismo): static
    {
        $this->animalismo = $animalismo;

        return $this;
    }

    public function getAtletismo(): ?int
    {
        return $this->atletismo;
    }

    public function setAtletismo(int $atletismo): static
    {
        $this->atletismo = $atletismo;

        return $this;
    }

    public function getCaos(): ?int
    {
        return $this->caos;
    }

    public function setCaos(int $caos): static
    {
        $this->caos = $caos;

        return $this;
    }

    public function getConocimientoMagico(): ?int
    {
        return $this->conocimientoMagico;
    }

    public function setConocimientoMagico(int $conocimientoMagico): static
    {
        $this->conocimientoMagico = $conocimientoMagico;

        return $this;
    }

    public function getEnganio(): ?int
    {
        return $this->enganio;
    }

    public function setEnganio(int $enganio): static
    {
        $this->enganio = $enganio;

        return $this;
    }

    public function getReligion(): ?int
    {
        return $this->religion;
    }

    public function setReligion(int $religion): static
    {
        $this->religion = $religion;

        return $this;
    }

    public function getHistoria(): ?int
    {
        return $this->historia;
    }

    public function setHistoria(int $historia): static
    {
        $this->historia = $historia;

        return $this;
    }

    public function getInterpretacion(): ?int
    {
        return $this->interpretacion;
    }

    public function setInterpretacion(int $interpretacion): static
    {
        $this->interpretacion = $interpretacion;

        return $this;
    }

    public function getIntimidacion(): ?int
    {
        return $this->intimidacion;
    }

    public function setIntimidacion(int $intimidacion): static
    {
        $this->intimidacion = $intimidacion;

        return $this;
    }

    public function getInvestigacion(): ?int
    {
        return $this->investigacion;
    }

    public function setInvestigacion(int $investigacion): static
    {
        $this->investigacion = $investigacion;

        return $this;
    }

    public function getJuegoDeManos(): ?int
    {
        return $this->juegoDeManos;
    }

    public function setJuegoDeManos(int $juegoDeManos): static
    {
        $this->juegoDeManos = $juegoDeManos;

        return $this;
    }

    public function getMedicina(): ?int
    {
        return $this->medicina;
    }

    public function setMedicina(int $medicina): static
    {
        $this->medicina = $medicina;

        return $this;
    }

    public function getNaturaleza(): ?int
    {
        return $this->naturaleza;
    }

    public function setNaturaleza(int $naturaleza): static
    {
        $this->naturaleza = $naturaleza;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(int $orden): static
    {
        $this->orden = $orden;

        return $this;
    }

    public function getPercepcion(): ?int
    {
        return $this->percepcion;
    }

    public function setPercepcion(int $percepcion): static
    {
        $this->percepcion = $percepcion;

        return $this;
    }

    public function getPerspicacia(): ?int
    {
        return $this->perspicacia;
    }

    public function setPerspicacia(int $perspicacia): static
    {
        $this->perspicacia = $perspicacia;

        return $this;
    }

    public function getPersuasion(): ?int
    {
        return $this->persuasion;
    }

    public function setPersuasion(int $persuasion): static
    {
        $this->persuasion = $persuasion;

        return $this;
    }

    public function getSigilo(): ?int
    {
        return $this->sigilo;
    }

    public function setSigilo(int $sigilo): static
    {
        $this->sigilo = $sigilo;

        return $this;
    }

    public function getSupervivencia(): ?int
    {
        return $this->supervivencia;
    }

    public function setSupervivencia(int $supervivencia): static
    {
        $this->supervivencia = $supervivencia;

        return $this;
    }

    public function getCompetencia(): ?int
    {
        return $this->competencia;
    }

    public function setCompetencia(?int $competencia): static
    {
        $this->competencia = $competencia;

        return $this;
    }

    public function getVida(): ?int
    {
        return $this->vida;
    }

    public function setVida(?int $vida): static
    {
        $this->vida = $vida;

        return $this;
    }

    public function getDescanso(): ?string
    {
        return $this->descanso;
    }

    public function setDescanso(?string $descanso): static
    {
        $this->descanso = $descanso;

        return $this;
    }

    public function getMana(): ?int
    {
        return $this->mana;
    }

    public function setMana(?int $mana): static
    {
        $this->mana = $mana;

        return $this;
    }

    public function getEnergia(): ?int
    {
        return $this->energia;
    }

    public function setEnergia(?int $energia): static
    {
        $this->energia = $energia;

        return $this;
    }

    public function getFuria(): ?int
    {
        return $this->furia;
    }

    public function setFuria(?int $furia): static
    {
        $this->furia = $furia;

        return $this;
    }

    public function getMovimiento(): ?int
    {
        return $this->movimiento;
    }

    public function setMovimiento(?int $movimiento): static
    {
        $this->movimiento = $movimiento;

        return $this;
    }

    public function getArmadura(): ?int
    {
        return $this->armadura;
    }

    public function setArmadura(?int $armadura): static
    {
        $this->armadura = $armadura;

        return $this;
    }

    public function getIniciativa(): ?int
    {
        return $this->iniciativa;
    }

    public function setIniciativa(?int $iniciativa): static
    {
        $this->iniciativa = $iniciativa;

        return $this;
    }

    public function getRecursoEspecial(): ?string
    {
        return $this->recursoEspecial;
    }

    public function setRecursoEspecial(?string $recursoEspecial): static
    {
        $this->recursoEspecial = $recursoEspecial;

        return $this;
    }

    public function getActor(): ?Actor
    {
        return $this->actor;
    }

    public function setActor(Actor $actor): static
    {
        // set the owning side of the relation if necessary
        if ($actor->getEstadisticas() !== $this) {
            $actor->setEstadisticas($this);
        }

        $this->actor = $actor;

        return $this;
    }
}

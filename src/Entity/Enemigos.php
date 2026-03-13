<?php

namespace App\Entity;

use App\Repository\EnemigosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnemigosRepository::class)]
class Enemigos extends Actor
{
    #[ORM\ManyToOne(inversedBy: 'enemigos')]
    private ?TipoEnemigo $tipoEnemigo = null;

    #[ORM\Column]
    private ?int $desafio = null;

    public function getTipoEnemigo(): ?TipoEnemigo
    {
        return $this->tipoEnemigo;
    }

    public function setTipoEnemigo(?TipoEnemigo $tipoEnemigo): static
    {
        $this->tipoEnemigo = $tipoEnemigo;

        return $this;
    }

    public function getDesafio(): ?int
    {
        return $this->desafio;
    }

    public function setDesafio(int $desafio): static
    {
        $this->desafio = $desafio;

        return $this;
    }
}

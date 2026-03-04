<?php

namespace App\Repository;

use App\Entity\Jugador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jugador>
 */
class JugadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jugador::class);
    }

    public function listarJugadores(): array{
        $em = $this->getEntityManager();
        $query = $em->createQuery(
        'SELECT j
        FROM App\Entity\Jugador j'
        );
        return $query->getResult();
    }
}

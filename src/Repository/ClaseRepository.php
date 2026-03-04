<?php

namespace App\Repository;

use App\Entity\Clase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Clase>
 */
class ClaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clase::class);
    }

    public function listarClases(): array{
        $em = $this->getEntityManager();
        $query = $em->createQuery(
        'SELECT c
        FROM App\Entity\Clase c'
        );
        return $query->getResult();
    }
}

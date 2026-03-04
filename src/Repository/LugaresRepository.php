<?php

namespace App\Repository;

use App\Entity\Lugares;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lugares>
 */
class LugaresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lugares::class);
    }

    public function listarLugares(): array{
        $em = $this->getEntityManager();
        $query = $em->createQuery(
        'SELECT l
        FROM App\Entity\Lugares l'
        );
        return $query->getResult();
    }
}

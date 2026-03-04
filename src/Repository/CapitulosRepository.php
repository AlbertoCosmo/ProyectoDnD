<?php

namespace App\Repository;

use App\Entity\Capitulos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Capitulos>
 */
class CapitulosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Capitulos::class);
    }

    public function listarCapitulos(): array{
        $em = $this -> getEntityManager();
        $query = $em -> createQuery(
            'SELECT c
            FROM App\Entity\Capitulos c'
        );
        return $query -> getResult();
    }
}

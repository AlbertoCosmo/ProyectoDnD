<?php

namespace App\Repository;

use App\Entity\Clase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClaseRepository extends ServiceEntityRepository
{
    use PaginatableRepositoryTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clase::class);
    }
}

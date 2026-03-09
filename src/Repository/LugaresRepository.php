<?php

namespace App\Repository;

use App\Entity\Lugares;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LugaresRepository extends ServiceEntityRepository
{
    use PaginatableRepositoryTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lugares::class);
    }
}

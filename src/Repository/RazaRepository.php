<?php

namespace App\Repository;

use App\Entity\Raza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RazaRepository extends ServiceEntityRepository
{
    use PaginatableRepositoryTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Raza::class);
    }
}

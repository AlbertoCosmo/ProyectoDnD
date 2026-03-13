<?php

namespace App\Repository\RepositoriosPrueba;

use App\Entity\EntidadesPrueba\Raza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\RepositoriosPrueba\FilterTrait;

class RazaRepository extends ServiceEntityRepository
{
    use FilterTrait;
    use PaginatableRepositoryTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Raza::class);
    }
}

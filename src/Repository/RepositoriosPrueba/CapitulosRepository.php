<?php

namespace App\Repository\RepositoriosPrueba;

use App\Entity\EntidadesPrueba\Capitulos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\RepositoriosPrueba\FilterTrait;

class CapitulosRepository extends ServiceEntityRepository
{
    use FilterTrait;
    use PaginatableRepositoryTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Capitulos::class);
    }
}

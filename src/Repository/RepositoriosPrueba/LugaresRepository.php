<?php

namespace App\Repository\RepositoriosPrueba;

use App\Entity\EntidadesPrueba\Lugares;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\RepositoriosPruebaFilterTrait;

class LugaresRepository extends ServiceEntityRepository
{
    use FilterTrait;
    use PaginatableRepositoryTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lugares::class);
    }
}

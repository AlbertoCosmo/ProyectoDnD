<?php

namespace App\Repository\RepositoriosPrueba;

use App\Entity\EntidadesPrueba\Npc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\RepositoriosPrueba\FilterTrait;

class NpcRepository extends ServiceEntityRepository
{
    use FilterTrait;
    use PaginatableRepositoryTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Npc::class);
    }
}

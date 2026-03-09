<?php

namespace App\Repository;

use App\Entity\Npc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NpcRepository extends ServiceEntityRepository
{
    use PaginatableRepositoryTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Npc::class);
    }
}

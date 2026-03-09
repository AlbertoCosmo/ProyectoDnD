<?php

namespace App\Repository;

use App\Entity\Personaje;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class PersonajeRepository extends ServiceEntityRepository
{
    use PaginatableRepositoryTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personaje::class);
    }
}

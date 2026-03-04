<?php

namespace App\Repository;

use App\Entity\Personaje;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class PersonajeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personaje::class);
    }

    public function listarPj(): array{
        $em = $this->getEntityManager();
        $query = $em->createQuery(
        'SELECT p
        FROM App\Entity\Personaje p'
        );
        return $query->getResult();
    }

    
}

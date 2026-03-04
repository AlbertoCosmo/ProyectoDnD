<?php

namespace App\Repository;

use App\Entity\Raza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Raza>
 */
class RazaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Raza::class);
    }

    public function listarRazas(): array{
        $em = $this->getEntityManager();
        $query = $em->createQuery(
        'SELECT r
        FROM App\Entity\Raza r'
        );
        return $query->getResult();
    }
}

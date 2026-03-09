<?php

namespace App\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

trait PaginatableRepositoryTrait
{
    public function buscarPaginado(string $busqueda, array $atributos, int $pagina, int $limite): Paginator
    {
        $qb = $this->createQueryBuilder('e');
        if (!empty($busqueda)) {
            foreach ($atributos as $a) {
                if ($a['tipo'] === 'text') {
                    $campo = $a['attr'];
                    $qb->orWhere("e.$campo LIKE :t");
                }
            }
            $qb->setParameter('t', '%' . $busqueda . '%');
        }
        $qb->setFirstResult(($pagina - 1) * $limite)
           ->setMaxResults($limite);

        return new Paginator($qb);
    }
}
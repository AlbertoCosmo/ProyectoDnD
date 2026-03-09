<?php

namespace App\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

trait PaginatableRepositoryTrait
{
    public function buscarPaginado(string $busqueda, array $campos, int $pagina, int $limite, string $campoEspecifico = ''): Paginator
    {
        $qb = $this->createQueryBuilder('e');

        if (!empty($busqueda) && !empty($campos)) {
            if (!empty($campoEspecifico)) {
                if (is_numeric($busqueda)) {
                    $qb->andWhere("e.$campoEspecifico = :t");
                } else {
                    $qb->andWhere("e.$campoEspecifico LIKE :t");
                }
            } else {
                $orX = $qb->expr()->orX();
                foreach ($campos as $campo) {
                    $orX->add($qb->expr()->like("e.$campo", ":t"));
                }
                $qb->andWhere($orX);
            }
            if($orX->count() > 0){
                $qb->andWhere($orX);
                $qb->setParamenter('t', '%'.$busqueda.'%');
            }

            $parametro = is_numeric($busqueda) ? $busqueda : '%' . $busqueda . '%';
            $qb->setParameter('t', $parametro);
        }

        $qb->setFirstResult(($pagina - 1) * $limite)->setMaxResults($limite);
        return new Paginator($qb);
    }
}

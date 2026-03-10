<?php

namespace App\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

trait PaginatableRepositoryTrait
{
    public function mostrarPaginaTabla(int $pagina, int $limite): Paginator
    {
        $qb = $this->createQueryBuilder('e');
        
        $qb->setFirstResult(($pagina - 1) * $limite)  //Mates para ver desde donde empieza a leer el controlador de la vista (pag 1 - 1 = 0, *10 = 0 = No se salta nada, y empieza a leer desde el dato 1)
           ->setMaxResults($limite);

        return new Paginator($qb);
    }
}

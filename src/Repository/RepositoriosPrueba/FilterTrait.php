<?php

namespace App\Repository\RepositoriosPrueba;

use Doctrine\ORM\QueryBuilder;

trait FilterTrait
{
    public function comprobarFiltro(QueryBuilder $qb, array $filtros, array $mapaTipos): QueryBuilder
    {
        foreach ($filtros as $campo => $valor) {
            if ($valor === null || $valor === '' || $valor === 'undefined') {
                continue;
            }

            $nombreParam = 'p_' . str_replace('.', '_', $campo);
            $tipo = $mapaTipos[$campo] ?? 'text';

            if ($tipo === 'relacion' || $tipo === 'bool') {
                $qb->andWhere("e.$campo = :$nombreParam")->setParameter($nombreParam, $valor);
            } else {
                $qb->andWhere("e.$campo LIKE :$nombreParam")->setParameter($nombreParam, "%$valor%");
            }
        }
        return $qb;
    }
}

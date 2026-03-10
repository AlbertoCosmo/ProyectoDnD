<?php

use Doctrine\ORM\QueryBuilder;

trait FilterableRepositoryTrait
{
    public function comprobarFiltro(QueryBuilder $qb, array $filtros, array $mapaTipos): QueryBuilder{
        if(empty($filtros)){
            return $qb;
        }
        foreach($filtros as $campo => $valor){
            $nombreAtributo = 'atr_'.str_replace('.','_',$campo);
            $tipo = $mapaTipos[$campo] ?? 'text';
            if($valor === null || $valor === ''){ //Si es null o vacio, skipeamos
                continue;
            }
            if($tipo === 'relacion' || $tipo === 'bool'){
                $qb->andWhere("e.$campo = :$nombreAtributo")->setParameter($nombreAtributo, $valor);
            }
            else{
                $qb->andWhere("e.$campo LIKE :$nombreAtributo")->setParameter($nombreAtributo, '%' .$valor.'%');
            }

        }
        return $qb;
    }
}
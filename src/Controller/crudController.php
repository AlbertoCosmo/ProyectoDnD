<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class crudController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}


    #[Route('/dnd/listar/{entidad}', name: 'dnd_crud_listar')]
    public function listarEntidad(string $entidad, Request $request): Response
    {
        $clase = "App\\Entity\\" . $entidad;
        $metodos = get_class_methods($clase);
        $repo = $this->em->getRepository($clase); 
        $vistaTabla = $request->query->get('vista', 'tabla');
    
        $pagina = $request->query->getInt('page', 1); //Página actual
        $maxDatos = ($vistaTabla === 'mosaico') ? 30 : 10; //Datos por página
        

        // REFLECTION PARA COMPROBAR SI ES UN OBJETO O UN DATO
        foreach ($metodos as $m) {
            if (str_starts_with($m, 'get') && $m !== 'getId') {
                $atributo = lcfirst(substr($m, 3));

                $relInversas = ['personajes', 'npcs', 'jugadores', 'lugares', 'clases', 'razas', 'capitulos'];
                if (in_array($atributo, $relInversas)) continue;

                $espejo = new \ReflectionMethod($clase, $m);
                $tipoRetorno = (string)$espejo->getReturnType();
                $tipoVisual = 'text';

                if (str_contains($tipoRetorno, 'Entity')) {
                    $tipoVisual = 'relacion';
                } elseif ($tipoRetorno === 'bool' || $tipoRetorno === 'boolean') {
                    $tipoVisual = 'bool';
                }

                $datosAtributo = [
                    'attr' => $atributo,
                    'etiqueta' => strtoupper($atributo),
                    'tipo' => $tipoVisual
                ];

                $arrayAtributos[] = $datosAtributo;

                if ($tipoVisual === 'text') {
                    $nombresCamposDeTexto[] = $atributo;
                }
            }
        }

        //Mapeo de filtro para usar luego desde fuera, en otro archivo
        $mapaTipoDato = [];
        foreach ($arrayAtributos as $a){
            $mapaTipoDato[$a['attr']] = $a['tipo'];
        }
        $filtroRecibido = $request -> query -> all('filtro');
        $repo = $this->em->getRepository($clase);
        $qb = $repo->createQueryBuilder('e');
        $qb = $repo->comprobarFiltro($qb, $filtroRecibido, $mapaTipoDato);

        $paginaMostrada = $repo->mostrarPaginaTabla($pagina, $maxDatos);
        $totalRegistros = count($paginaMostrada); //Paginator calcula cuantas entradas hay, para calcular el total de registros con count. Cuenta TODOS los registros, no solo los de la página actual.
        $totalPaginas = max(1, ceil($totalRegistros / $maxDatos));

        return $this->render('dnd/plantillas/plantillaTablas.html.twig', [
            'datos' => $paginaMostrada,
            'atributos' => $arrayAtributos,
            'nombre_seccion' => $entidad,
            'pagina_actual' => $pagina,
            'total_paginas' => $totalPaginas,
            'vista_actual' => $vistaTabla
        ]);
    }


    #[Route('/dnd/editar/{entidad}/{id}', name: 'dnd_crud_editar')]
    public function editarEntidad(string $entidad, int $id, Request $request): Response
    {
        $claseCompleta = "App\\Entity\\" . $entidad;
        $objeto = $this->em->getRepository($claseCompleta)->find($id);

        $metodos = get_class_methods($claseCompleta);
        $camposEditables = [];

        foreach ($metodos as $m) {
            if (str_starts_with($m, 'get') && $m !== 'getId') {
                $nombreBase = substr($m, 3);
                $metodoSetter = 'set' . $nombreBase;
                $propiedad = lcfirst($nombreBase);

                if (in_array($metodoSetter, $metodos)) {
                    // Filtro temporal
                    $relInversas = ['personajes', 'npcs', 'jugadores', 'lugares', 'clases', 'razas'];
                    if (in_array($propiedad, $relInversas)) continue;

                    $espejo = new \ReflectionMethod($claseCompleta, $m);
                    $tipoRetorno = (string)$espejo->getReturnType();

                    $config = [
                        'attr' => $propiedad,
                        'valor' => $objeto->$m(),
                        'tipo' => 'text'
                    ];

                    if (str_contains($tipoRetorno, 'Entity')) {
                        $config['tipo'] = 'select';
                        $claseRelacionada = str_replace(['?', 'Proxies\__CG__\\'], '', $tipoRetorno);
                        $config['opciones'] = $this->em->getRepository($claseRelacionada)->findAll();
                    } elseif ($tipoRetorno === 'bool') {
                        $config['tipo'] = 'bool';
                    }

                    $camposEditables[] = $config;
                }
            }
        }
        return $this->render('dnd/plantillas/_filaEdicion.html.twig', [
            'campos' => $camposEditables,
            'id' => $id,
            'entidad' => $entidad
        ]);
    }

    #[Route('/dnd/guardar/{entidad}/{id}', name: 'dnd_crud_guardar', methods: ['POST'])]
    public function guardarEntidad(string $entidad, int $id, Request $request): Response
    {
        $claseCompleta = "App\\Entity\\" . $entidad;
        $objeto = $this->em->getRepository($claseCompleta)->find($id);

        foreach ($request->request->all() as $propiedad => $valor) {
            $metodoSetter = 'set' . ucfirst($propiedad);

            if (method_exists($objeto, $metodoSetter)) {
                $reflexion = new \ReflectionMethod($claseCompleta, $metodoSetter);
                $parametros = $reflexion->getParameters();
                $parametro = $parametros[0];
                $tipo = $parametro->getType();
                $tipoClase = ($tipo instanceof \ReflectionNamedType) ? $tipo->getName() : null;

                if ($tipoClase && (str_contains($tipoClase, 'Entity') || class_exists($tipoClase))) {
                    $claseRelacionada = ltrim(str_replace('?', '', $tipoClase), '\\');
                    if (!empty($valor)) {
                        $valor = $this->em->getRepository($claseRelacionada)->find($valor);
                    } else {
                        $valor = null;
                    }
                } elseif ($tipoClase === 'bool') {
                    $valor = (bool)$valor; //Convierte "1" en true y "0" en false
                } elseif ($tipoClase === 'int') {
                    $valor = (int)$valor;
                }

                $objeto->$metodoSetter($valor);
            }
        }

        $this->em->flush();
        return new Response("OK");
    }
}

<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ClaseRepository;
use App\Repository\JugadorRepository;
use App\Repository\LugaresRepository;
use App\Repository\PersonajeRepository;
use App\Repository\RazaRepository;
use App\Repository\CapitulosRepository;
use App\Repository\NpcRepository;
use App\Entity\Npc;
use App\Form\NpcType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class crudController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em) {}


    #[Route('/dnd/listar/{entidad}', name: 'dnd_crud_listar')]
    public function listarEntidad(string $entidad, Request $request): Response{
        $clase = "App\\Entity\\".$entidad;
        $metodos = get_class_methods($clase);
        $atributos = [];

        foreach($metodos as $m){
            if(str_starts_with($m, 'get') && $m !== 'getId'){
                $atributo = lcfirst(substr($m, 3));

                //FILTRO TEMPORAL PARA ANIDADAS
                $relInversas = ['personajes', 'npcs', 'jugadores', 'lugares', 'clases', 'razas', 'capitulos'];
                if (in_array($campo, $relInversas)) continue;

                $espejo = new \ReflectionMethod($clase, $m);
                $tipoRetorno = (string)$espejo->getReturnType();
                $tipoVisual = 'text';
                if (str_contains($tipoRetorno, 'Entity')) {
                    $tipoVisual = 'relacion'; //Detectar si es un objeto lo que nos devuelve
                } elseif ($tipoRetorno === 'bool' || $tipoRetorno === 'boolean') {
                    $tipoVisual = 'bool'; 
                }

                $arrayAtributos[] = [
                    'attr' => $campo,
                    'etiqueta' => strtoupper($campo),
                    'tipo' => 'text'
                ];
            }
        }
        $repo = $this -> em -> getRepository($clase);
        return $this -> render('dnd/plantillas/tablaListar.html.twig',[
            'datos' => $repo -> findAll(),
            'atributos' => $arrayAtributos,
            'nombre_seccion' => $entidad
        ]);
    }

    #[Route('/dnd/editar/{entidad}', name: 'dnd_crud_editar')]
    public function editarEntidad(string $entidad, Request $request, int $id): Response{
        $clase = "App\\Entity\\".$entidad;
        $objeto = $this -> em -> getRepository($clase) -> find($id);
        $metodos = get_class_methods($clase);

        if(!$objeto){
            throw $this -> createNotFoundException("No hay registro")
        }
        foreach ($metodos as $m){
            if(str_starts_with($m, 'get') && $m !== 'getId'){
                $atributo = lcfirst(substr($m, 3));
                
                //FILTRO TEMPORAL PARA ANIDADAS
                $relInversas = ['personajes', 'npcs', 'jugadores', 'lugares', 'clases', 'razas', 'capitulos'];
                if (in_array($campo, $relInversas)) continue;

                $espejo = new \ReflectionMethod($clase, $m);
                $tipoRetorno = (string)$espejo->getReturnType();
        }
    }

}
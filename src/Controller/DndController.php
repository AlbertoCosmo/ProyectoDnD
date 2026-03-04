<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
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
use Symfony\Component\Routing\Attribute\Route;

final class DndController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em){
    }

    // CARGA BÁSICA DE LA PÁGINA
    #[Route('/dnd', name:'paginaBase')]
    public function indexBase(): Response{
        return $this->render('dnd/paginaBase.html.twig');
    }

    private function renderAjaxSimple(Request $request, string $vista, array $extraData = []): Response{
        if($request->isXmlHttpRequest()){
            return $this -> render($vista);
        }
        return $this -> render ('dnd/paginaBase.html.twig',['seccion_actual' => $vista]);
    }

    //METODO CREADO PARA EVITAR REPETIR CODIGO DE IFS AL CARGAR LOS AJAX EN LAS FUNCIONES DEL CONTROLADOR
    private function renderAjax(Request $request, string $vista, $repository, string $nombreVariable, array $extraData = []): Response{
        $sort = $request->query->get('sort', 'id');
        $direction = $request->query->get('direction', 'ASC');
        
        //Querybuilder para poder buscar datos de tablas relacionadas
        $queryBuilder = $repository->createQueryBuilder('q');
        if(str_contains($sort, '.')){
            [$relacion, $campo] = explode('.', $sort);
            $queryBuilder->leftJoin("q.$relacion", 'rel')->orderBy("rel.$campo", $direction);
        } else {
            $queryBuilder->orderBy("q.$sort", $direction);
        }
        $datos = $queryBuilder->getQuery()->getResult();
        
        $data = array_merge($extraData, [
        $nombreVariable => $datos,
        'datos' => $datos, 
        'sort' => $sort,
        'direction' => $direction
    ]);

        if ($request->isXmlHttpRequest()){
            return $this -> render ($vista, $data);
        }
        return $this -> render ('dnd/paginaBase.html.twig', array_merge($data, ['seccion_actual' => $vista]));
    }

    //FUNCIÓN PARA FORMULARIOS
    private function cargarFormulario(Request $request, string $tipoForm, object $entidad, string $ruta): ? Response{
        $form = $this->createForm($tipoForm, $entidad);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($entidad);
            $this->em->flush();

            return $this->redirectToRoute($ruta);
        }
        return null;
    }

    //CARGA DE PORTADA
    #[Route('/dnd/portada', name:'dnd_portada')]
        public function vistaPortada(): Response{
            return $this->render('dnd/secciones/portada.html.twig');
        }

    #[Route('/dnd/listar', name:'listar_objetos')]
        public function vistaListar(Request $request): Response{
            return $this->renderAjaxSimple($request, 'dnd/portada/listar.html.twig');
        }
    #[Route('/dnd/editar', name:'editar_objetos')]
        public function vistaEditar(Request $request): Response{
            return $this->renderAjaxSimple($request, 'dnd/portada/editar.html.twig');
        }
    #[Route('/dnd/borrar', name:'borrar_objetos')]
        public function vistaBorrar(Request $request): Response{
            return $this->renderAjaxSimple($request, 'dnd/portada/borrar.html.twig');
        }
    #[Route(name:'volver')]
    public function volver(Request $request): Response{
        return $this->renderAjaxSimple($request, 'dnd/secciones/portada.html.twig');
    }

    // CARGA DE JUGADORES
    #[Route('/dnd/jugadores', name:'dnd_jugadores')]
    public function vistaJugadores(JugadorRepository $repo, Request $request): Response{
        return $this->renderAjax($request, 'dnd/secciones/jugadores.html.twig', $repo, 'jugadores');
    }

    // CARGA DE PERSONAJES
    #[Route('/dnd/personajes', name:'dnd_personajes')]
    public function vistaPersonajes(PersonajeRepository $repo, Request $request): Response{
        return $this->renderAjax($request, 'dnd/secciones/personajes.html.twig', $repo, 'personajes');
    }

    // CARGA DE LORE (AUN POR AÑADIR)
    #[Route('/dnd/lore', name:'dnd_lore')]
    public function vistaLore(Request $request): Response{
        return $this -> render('dnd/secciones/lore.html.twig');
    }

    // CARGA DE CAPITULOS
    #[Route('/dnd/capitulos', name:'dnd_capitulos')]
    public function vistaCapitulos(CapitulosRepository $repo, Request $request): Response{
        return $this->renderAjax($request, 'dnd/secciones/capitulos.html.twig', $repo, 'capitulos');
    }
    /*
    #[Route('master/capitulo/{id}', name: 'resumenCapitulo')]
    public function resumenCapitulo(int $id, CapitulosRepository $capRep): Response
    {
        $capitulo = $capRep->find($id);
        return $this->render('dnd/capitulos.html.twig', ['capSelect' => $capitulo]);
    }
    */

    // CARGA DE NPCS
    #[Route('/dnd/npcs', name:'dnd_npcs')]
    public function vistaNpcs(NpcRepository $repo, Request $request, EntityManagerInterface $em): Response{
        $npc = new Npc();
        $respuestaForm = $this->cargarFormulario($request, NpcType::class, $npc, 'dnd_npcs');
        if($respuestaForm){
            return $respuestaForm;
        }
        return $this->renderAjax($request, 'dnd/secciones/npcs.html.twig', $repo, 'npcs', [
            'form' => $this->createForm(NpcType::class, $npc)->createView()
        ]);
    }

    // CARGA DE LUGARES
    #[Route('/dnd/lugares', name:'dnd_lugares')]
    public function vistaLugares(LugaresRepository $repo, Request $request): Response{
        $atributos = [
            ['attr' => 'id', 'etiqueta' => 'ID', 'tipo' => 'readonly'],
            ['attr' => 'Nombre', 'etiqueta' => 'NOMBRE', 'tipo' => 'text'],
            ['attr' => 'Descripcion', 'etiqueta' => 'DESCRIPCIÓN', 'tipo' => 'text']
        ];
        return $this->renderAjax($request, 'dnd/secciones/lugares.html.twig', $repo, 'lugares',['atributos' => $atributos]);
    }

    // CARGA DE CLASES
    #[Route('/dnd/clases', name:'dnd_clases')]
    public function vistaClases(ClaseRepository $repo, Request $request): Response{
        return $this->renderAjax($request, 'dnd/secciones/clases.html.twig', $repo, 'clases');
    }

    // CARGA DE RAZAS
    #[Route('/dnd/razas', name:'dnd_razas')]
    public function vistaRazas(RazaRepository $repo, Request $request): Response{
        $atributos = [
            ['attr' => 'id', 'etiqueta' => 'ID', 'tipo' => 'readonly'],
            ['attr' => 'Nombre', 'etiqueta' => 'NOMBRE', 'tipo' => 'text'],
            ['attr' => 'origen', 'etiqueta' => 'ORIGEN', 'tipo' => 'text'],
            ['attr' => 'Descripcion', 'etiqueta' => 'DESCRIPCION', 'tipo' => 'text']
        ];
        return $this->renderAjax($request, 'dnd/secciones/razas.html.twig', $repo, 'razas', ['atributos' => $atributos]);
    }

    // CARGA DE MULTIMEDIA (AUN POR HACER)
    #[Route('/dnd/multimedia', name:'dnd_multimedia')]
    public function vistaMultimedia(Request $request): Response{
        return $this -> render('dnd/secciones/multimedia.html.twig');
    }

    //LISTAR
    #[Route('/dnd/listar/{clase}', name: 'dnd_listar_dinamico')]
    public function listarDinamico(string $clase, Request $request, EntityManagerInterface $em): Response 
    {
    $nombreClase = "App\\Entity\\" . ucfirst($clase);
    $metodos = get_class_methods($nombreClase);
    $atributos = [];

    foreach ($metodos as $metodo) {
        if (str_starts_with($metodo, 'get') && $metodo !== 'getId') {
            $propiedad = lcfirst(substr($metodo, 3));
            $relInversas = ['personajes','npcs','jugadores','lugares','clases','razas'];
            if(in_array($propiedad, $relInversas)) {
                continue;
            }
            $atributos[] = [
                'attr' => $propiedad,
                'etiqueta' => strtoupper($propiedad),
                'tipo' => 'text'
            ];
        }
    }
    $repositorio = $em->getRepository($nombreClase);
    return $this->renderAjax($request, 'dnd/plantillas/tablaListar.html.twig', $repositorio, 'datos', [
        'atributos' => $atributos,
        'nombre_seccion' => $clase
    ]);
}

        
}


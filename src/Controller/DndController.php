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

    // CARGA DE LORE (AUN POR AÑADIR)
    #[Route('/dnd/lore', name:'dnd_lore')]
    public function vistaLore(Request $request): Response{
        return $this -> render('dnd/secciones/lore.html.twig');
    }

    // CARGA DE MULTIMEDIA (AUN POR HACER)
    #[Route('/dnd/multimedia', name:'dnd_multimedia')]
    public function vistaMultimedia(Request $request): Response{
        return $this -> render('dnd/secciones/multimedia.html.twig');
    }

}


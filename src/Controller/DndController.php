<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
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

    //CARGA DE PORTADA (AUN POR HACER)
    #[Route('/dnd/inicio', name:'dnd_portada')]
    public function vistaPortada(Request $request): Response{
        return $this -> render('dnd/secciones/portada.html.twig');
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


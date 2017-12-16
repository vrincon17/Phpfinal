<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends Controller
{
    /**
     * @Route("/usuario", name="Usuario")
     */
    public function indexAction(Request $request)
    {
        $usuarioNombre="Reinaldo Alberto Lopez";
        // replace this example code with whatever you need
        return $this->render('AppBundle::Usuario:Usuario.html.twig', array(
            'nombre' => $usuarioNombre,

        ));
    }
}

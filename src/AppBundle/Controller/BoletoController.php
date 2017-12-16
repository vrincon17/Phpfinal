<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BoletoController extends Controller
{
    /**
     * @Route("/boleto", name="boleto")
     */
    public function indexAction(Request $request)
    {
        $usuarioNombre="Reinaldo Alberto Lopez";
        // replace this example code with whatever you need
        return $this->render('AppBundle::usuario.html.twig', array(
            'nombre' => $usuarioNombre,

        ));
    }
}

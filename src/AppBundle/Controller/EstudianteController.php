<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Form\EstudianteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Estudiante;

/**
 * Class EstudianteController
 * @package AppBundle\Controller
 * @Route("/estudiante")
 *
 */

class EstudianteController extends Controller
{


    /**
     * @Route("/lista", name="lista_estudiante")
     * @param Request $request
     */
    public function listaEstudiant(Request $request)
    {
        //TODO: buscar lista de estudiante en la base de datos
        $estudiante = $this->getDoctrine()->getRepository(Estudiante::class)->findAll();
        return $this->render('AppBundle:Estudiante:estudiante_lista.html.twig', array(
            'estudiantes' => $estudiante,
        ));
    }

    /**
     * @Route("/", name="crear_estudiante")
     * @param Request $request
     * @Method("POST")
     */
    public function createEstudiante(Request $request)
    {


        $data = json_decode($request->getContent(), true);


        $estudiante = new Estudiante();
        $form = $this->createForm(EstudianteType::class, $estudiante);

        $form->submit($data);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($estudiante);

            $em->flush();

        } else {

        }

        $data = $this->get('serializer')->serialize($estudiante, 'json');

        $newEstudiante = json_decode($data, true);

        return new JsonResponse($newEstudiante);

    }

    /**
     * @Route("/{id}", name="actualizar_estudiante",options={"expose"=true})
     * @param Estudiante $estudiante
     * @param Request $request
     * @Method({"PUT"})
     * return JasonResponse
     */
    public function actualizarEstudiante(Request $request, Estudiante $estudiante)
    {


        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(EstudianteType::class, $estudiante);

        $form->submit($data);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getEntityManager();
           //$em->persist($estudiante);

            $em->flush();

        } else {

        }

        $data = $this->get('serializer')->serialize($estudiante, 'json');

        $newEstudiante = json_decode($data, true);

        return new JsonResponse($newEstudiante);

    }

    /**
     * @Route("/", name="api_list_estudiante")
     * @param Request $request
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function getEstudiantes(Request $request)
    {

        $estudiantes = $this->getDoctrine()->getRepository(Estudiante::class)->findAll();

        $data = $this->get('serializer')->serialize($estudiantes, 'json');
        $listaEstudiante = json_decode($data, true);

        return new JsonResponse($listaEstudiante);
    }


    /**
     * @Route("/{id}", name="api_list_estudiante", requirements={"id"="\d+"} )
     * @param Request $request
     * @Method("GET")
     * @param Estudiante $estudiante
     * @return JsonResponse
     */
    public function getEstudiante(Request $request, Estudiante $estudiante)
    {


        $data = $this->get('serializer')->serialize($estudiante, 'json');
        $estudiante = json_decode($data, true);

        return new JsonResponse($estudiante);

    }

    /**
     * @Route("/{id}/edit", name="edit_estudiante", requirements={"id"="\d+"} )
     * @param Request $request
     * @Method("GET")
     * @param Estudiante $estudiante
     * return JsonResponse
     */
    public function EditEstudiantes(Request $request, Estudiante $estudiante)
    {

        return $this->render('AppBundle:Estudiante:edit_estudiante.html.twig',
        array ("estudiante"=>$estudiante)
        );


    }
}

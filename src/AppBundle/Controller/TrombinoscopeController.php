<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Groupe;
/**
 * Personne controller.
 *
 * @Route("/trombinoscope")
 */
class TrombinoscopeController extends Controller
{
    /**
     * Lists all groupe entities.
     *
     * @Route("/", name="trombinoscope")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository('AppBundle:Groupe')->findAll();

        return $this->render('groupe/index.html.twig', array(
            'groupes' => $groupes,
        ));
    }
}

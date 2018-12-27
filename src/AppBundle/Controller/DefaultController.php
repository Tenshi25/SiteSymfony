<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/SiteMons", name="accueil")
     */
    public function AccueilAction(Request $request)
    {
        // replace this example code with whatever you need
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('visiteur/accueil.html.twig');
    }

    /**
     * @Route("/Centre d'intéret", name="PageCentreInteret")
     * @Method("GET")
     */
    public function PageCentreInteretAction()
    {
        $em = $this->getDoctrine()->getManager();

        $centreInterets = $em->getRepository('AppBundle:CentreInteret')->findAll();

        return $this->render('centreinteret/page.html.twig', array(
            'centreInterets' => $centreInterets,
        ));
    }
    /**
     * @Route("Groupe", name="PageGroupe")
     * @Method("GET")
     */
    public function PageGroupeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository('AppBundle:Groupe')->findAll();
        //var_dump($groupes[0]->getPersonneStatuts());
        return $this->render('groupe/page.html.twig', array(
            'groupes' => $groupes,
        ));
    }
}

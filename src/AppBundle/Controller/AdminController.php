<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{

    /**
     * @Route("/admin/menu", name="menuAdmin")
     */

    public function MenuAction(Request $request)
    {
        // replace this example code with whatever you need
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('MenuAdmin/menuAdmin.html.twig');
    }
    /**
     * @Route("/admin/menu/CentreIntéret", name="menuAdminCentreInteret")
     */

    public function MenuCentreInteretAction(Request $request)
    {
        // replace this example code with whatever you need
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('MenuAdmin/menuCentreinteret.html.twig');
    }
    /**
     * @Route("/admin/menu/Groupe", name="menuAdminGroupe")
     */
    public function MenuGroupeAction(Request $request)
    {
        // replace this example code with whatever you need
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('MenuAdmin/menuGroupe.html.twig');
    }



}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentreInteret;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\Length;

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
        $em = $this->getDoctrine()->getManager();

        // replace this example code with whatever you need
        //$this->denyAccessUnlessGranted('ROLE_USER');
        $themePage = $em->getRepository('AppBundle:ThemePage')->findOneBy(array('libTheme' => 'accueil'));
        $accueil = $em->getRepository('AppBundle:Page')->findOneBy(array('ThemePage' => $themePage));
        return $this->render('visiteur/accueil.html.twig',array(
        'accueil' => $accueil,


    ));
    }

    /**
     * @Route("/Centre d'intéret", name="PageCentreInteret")
     * @Method("GET")
     */
    public function PageCentreInteretAction()
    {
        $em = $this->getDoctrine()->getManager();

        $centresInterets = $em->getRepository('AppBundle:CentreInteret')->findAll();
        $categoriesCentreInteret = $em->getRepository('AppBundle:CategorieCentreInteret')->findAll();
        return $this->render('visiteur/pageCentresInterets.html.twig', array(
            'centresInterets' => $centresInterets,
            'categoriesCentreInteret'=>$categoriesCentreInteret

        ));
    }
    /**
     * @Route("Groupe", name="PageGroupe")
     * @Method("GET")
     */
    public function PageGroupeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $groupeType = $em->getRepository('AppBundle:TypeGroupe')->findOneBy(array('libelle' => "Commission"));
        $groupes = $em->getRepository('AppBundle:Groupe')->findBy(array('typeGroup' => $groupeType));
        //$groupes = $em->getRepository('AppBundle:Groupe')->findAll();
        //var_dump($groupes[0]->getPersonneStatuts());
        return $this->render('groupe/page.html.twig', array(
            'groupes' => $groupes,
        ));
    }

    /**
     * @Route("Trombinoscope", name="PageTrombinoscope")
     * @Method("GET")
     */
    public function TrombinoscopeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $conseilMunicipal = $em->getRepository('AppBundle:Groupe')->findOneBy(array('nom' => 'Conseil Municipal'));
        $listeStatus=$em->getRepository('AppBundle:Statut')->findBy(array(),array( 'ordre' => 'ASC'));
        return $this->render('visiteur/maMairie/trombinoscope.html.twig', array(
            'conseilMunicipal' => $conseilMunicipal,
            'listeStatus' =>$listeStatus
        ));
    }

    public function searchAction(Request $request)
    {
        $search = NULL;
        $formulaire = $this->createFormBuilder()
            ->setAction($this->generateUrl('search_results', array('categorie' => $search)))
            ->setMethod('GET')
            //->add('search', SearchType::class, array('constraints' => new Length(array('min' => 4)), 'attr' => array('placeholder' => 'Rechercher un centre d\'interêts','class' => 'Rechercher un centre d\'interêts') ))
            ->add('send', SubmitType::class, array('label' => 'Rechercher'))
            ->add('categorie', EntityType::class, array(
                'class'=>'AppBundle\Entity\CategorieCentreInteret',
                'choice_label'=>'libCat',
                'expanded'=> false,
                'multiple'=>false
            ))
            ->getForm();

        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid())
        {
            $search = $formulaire['search']->getData();

            return $this->redirectToRoute('search_results', array('search' => $search));

        }
        return $this->render('searchBar.html.twig', array(
            'formulaire' => $formulaire->createView()
        ));

    }
    /**
     * @Route("search_results", name="search_results")
     * @Method("GET")
     */
    public function search_resultsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $request->query->get('form');
        $idcategorie = $form['categorie'];
        $categorie =$em->getRepository('AppBundle:CategorieCentreInteret')->findOneBy(array('id'=>$idcategorie));
        $categoriesCentreInteret = $em->getRepository('AppBundle:CategorieCentreInteret')->findAll();
        $centresInterets = $em->getRepository(CentreInteret::class)->findBy(array('Categorie'=>$categorie));
        // Ici on utilise une requête créée dans le GeneralRepository

        return $this->render('visiteur/searchPageCentresInterets.html.twig', array('categorie' => $categorie, 'centresInterets' => $centresInterets, 'categoriesCentreInteret'=>$categoriesCentreInteret));


       /* $em = $this->getDoctrine()->getManager();
        $request->query->all();
        $centresInterets = $em->getRepository('AppBundle:CentreInteret')->findAll();
        $categoriesCentreInteret = $em->getRepository('AppBundle:CategorieCentreInteret')->findBy();
        return $this->render('visiteur/searchPageCentresInterets.html.twig', array(
            'centresInterets' => $centresInterets,
            'categoriesCentreInteret'=>$categoriesCentreInteret,
            'search'=>$request

        ));*/
    }
}

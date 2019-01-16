<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FairePartiStatut;
use AppBundle\Entity\Groupe;
use AppBundle\Entity\TypeGroupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Fairepartistatut controller.
 *
 * @Route("admin/faire_parti_statut")
 */
class FairePartiStatutController extends Controller
{
    /**
     * Lists all fairePartiStatut entities.
     *
     * @Route("/", name="admin_faire_parti_statut_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fairePartiStatuts = $em->getRepository('AppBundle:FairePartiStatut')->findAll();

        return $this->render('fairepartistatut/index.html.twig', array(
            'fairePartiStatuts' => $fairePartiStatuts,
        ));
    }

    /**
     * Creates a new fairePartiStatut entity.
     *
     * @Route("/new/{groupe}", name="admin_faire_parti_statut_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,Groupe $groupe)
    {
        $fairePartiStatut = new Fairepartistatut();
        $form = $this->createForm('AppBundle\Form\FairePartiStatutType', $fairePartiStatut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fairePartiStatut);
            $em->flush();
            
            return $this->redirectToRoute('admin_groupe_show', array('id' => array('id' => $groupe->getId())));
        }

        return $this->render('fairepartistatut/new.html.twig', array(
            'fairePartiStatut' => $fairePartiStatut,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new fairePartiStatut entity.
     *
     * @Route("/new/{groupe}", name="admin_fairePartiGroupe_new")
     * @Method({"GET", "POST"})
     */
    public function newGroupeAction(Request $request,groupe $groupe)
    {
        $fairePartiStatut = new Fairepartistatut();
/*
        $formulaire = $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fairePartiGroupe_new', array('groupe' => $groupe->getId())))

            ->add('personne', EntityType::class, array(
                'class'=>'AppBundle\Entity\Personne',
                'choice_label'=>'NomPrenom',
                'expanded'=> false,
                'multiple'=>false
            ))
            ->add('statut', EntityType::class, array(
                'class'=>'AppBundle\Entity\Statut',
                'choice_label'=>'nom',
                'expanded'=> false,
                'multiple'=>false
            ))
            ->getForm();
        $formulaire->handleRequest($request);
*/



        $form = $this->createForm('AppBundle\Form\FairePartiStatutType', $fairePartiStatut);
        //$form->remove('groupe');
        //$form->add('groupe','AppBundle\Form\GroupeType');
        $form->get('groupe')->setData($groupe);
        $form->get('groupe')->isDisabled();
        //$form->setData($groupe);
        //$form->setParent($groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fairePartiStatut);
            $em->flush();

            return $this->redirectToRoute('admin_faire_parti_statut_show', array('id' => $fairePartiStatut->getId()));
        }

        return $this->render('fairepartistatut/new.html.twig', array(
            'fairePartiStatut' => $fairePartiStatut,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a fairePartiStatut entity.
     *
     * @Route("/{id}", name="admin_faire_parti_statut_show")
     * @Method("GET")
     */
    public function showAction(FairePartiStatut $fairePartiStatut)
    {
        $deleteForm = $this->createDeleteForm($fairePartiStatut);

        return $this->render('fairepartistatut/show.html.twig', array(
            'fairePartiStatut' => $fairePartiStatut,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fairePartiStatut entity.
     *
     * @Route("/{id}/edit", name="admin_faire_parti_statut_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FairePartiStatut $fairePartiStatut)
    {
        $deleteForm = $this->createDeleteForm($fairePartiStatut);
        $editForm = $this->createForm('AppBundle\Form\FairePartiStatutType', $fairePartiStatut);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_faire_parti_statut_edit', array('id' => $fairePartiStatut->getId()));
        }

        return $this->render('fairepartistatut/edit.html.twig', array(
            'fairePartiStatut' => $fairePartiStatut,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fairePartiStatut entity.
     *
     * @Route("/{id}/delete", name="admin_faire_parti_statut_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FairePartiStatut $fairePartiStatut)
    {
        $form = $this->createDeleteForm($fairePartiStatut);
        $form->handleRequest($request);

        /*if ($form->isSubmitted() && $form->isValid()) {*/
            $em = $this->getDoctrine()->getManager();
            $em->remove($fairePartiStatut);
            $em->flush();
       // }

        return $this->redirectToRoute('admin_groupe_index' );
    }

    /**
     * Creates a form to delete a fairePartiStatut entity.
     *
     * @param FairePartiStatut $fairePartiStatut The fairePartiStatut entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FairePartiStatut $fairePartiStatut)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_faire_parti_statut_delete', array('id' => $fairePartiStatut->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

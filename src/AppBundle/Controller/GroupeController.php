<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FairePartiStatut;
use AppBundle\Entity\Groupe;
use AppBundle\Repository\FairePartiStatutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Groupe controller.
 *
 * @Route("admin/groupe")
 */
class GroupeController extends Controller
{
    /**
     * Lists all groupe entities.
     *
     * @Route("/", name="admin_groupe_index")
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

    /**
     * Creates a new groupe entity.
     *
     * @Route("/new", name="admin_groupe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $groupe = new Groupe();
        $form = $this->createForm('AppBundle\Form\GroupeType', $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush();

            return $this->redirectToRoute('admin_groupe_show', array('id' => $groupe->getId()));
        }

        return $this->render('groupe/new.html.twig', array(
            'groupe' => $groupe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a groupe entity.
     *
     * @Route("/{id}", name="admin_groupe_show")
     * @Method({"GET","POST"})
     */
    public function showAction(Request $request,Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();
        // création de la liste des personne qui appratiennt a ce groupe
        $listeFaireParti = $em->getRepository('AppBundle:FairePartiStatut')->findby(array('groupe'=> $groupe));

        $fairePartiStatut = new Fairepartistatut();

        // création du formulaire de suppression d'un groupe
        $deleteForm = $this->createDeleteForm($groupe);


        // création du formulaire de suppression d'un lien entre personne, statut et groupe
        //$deleteFormFairePartiStatut = $this->createDeleteForm2($fairePartiStatut2);
        // création du formulaire d'ajout d'un lien entre personne, statut et groupe
        $form = $this->createForm('AppBundle\Form\FairePartiStatutType',$fairePartiStatut);
        $form->remove('groupe');

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $fairePartiStatut->setGroupe($groupe);
            $em->persist($fairePartiStatut);
            $em->flush();

            return $this->redirectToRoute('groupe/show.html.twig', array('id' => $groupe->getId()));
        }

        return $this->render('groupe/show.html.twig', array(
            'groupe' => $groupe,
            'listeFaireParti' => $listeFaireParti,
            'delete_form' => $deleteForm->createView(),
            'form_ajout' => $form->createView(),
            //'delete_form_faireparti' => $deleteFormFairePartiStatut->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing groupe entity.
     *
     * @Route("/{id}/edit", name="admin_groupe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Groupe $groupe)
    {
        $deleteForm = $this->createDeleteForm($groupe);
        $editForm = $this->createForm('AppBundle\Form\GroupeType', $groupe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_groupe_edit', array('id' => $groupe->getId()));
        }

        return $this->render('groupe/edit.html.twig', array(
            'groupe' => $groupe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a groupe entity.
     *
     * @Route("/{id}/delete", name="admin_groupe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Groupe $groupe)
    {
        $form = $this->createDeleteForm($groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupe);
            $em->flush();
        }

        return $this->redirectToRoute('admin_groupe_index');
    }

    /**
     * Creates a form to delete a groupe entity.
     *
     * @param Groupe $groupe The groupe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Groupe $groupe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_groupe_delete', array('id' => $groupe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Creates a form to delete a fairePartiStatut entity.
     *
     * @param FairePartiStatut $fairePartiStatut The fairePartiStatut entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm2(FairePartiStatut $fairePartiStatut)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_faire_parti_statut_delete', array('id' => $fairePartiStatut->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}

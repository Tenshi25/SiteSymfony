<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypeGroupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Typegroupe controller.
 *
 * @Route("/admin/typegroupe")
 */
class TypeGroupeController extends Controller
{
    /**
     * Lists all typeGroupe entities.
     *
     * @Route("/", name="typegroupe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeGroupes = $em->getRepository('AppBundle:TypeGroupe')->findAll();

        return $this->render('typegroupe/index.html.twig', array(
            'typeGroupes' => $typeGroupes,
        ));
    }

    /**
     * Creates a new typeGroupe entity.
     *
     * @Route("/new", name="typegroupe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeGroupe = new Typegroupe();
        $form = $this->createForm('AppBundle\Form\TypeGroupeType', $typeGroupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeGroupe);
            $em->flush();

            return $this->redirectToRoute('typegroupe_show', array('id' => $typeGroupe->getId()));
        }

        return $this->render('typegroupe/new.html.twig', array(
            'typeGroupe' => $typeGroupe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeGroupe entity.
     *
     * @Route("/{id}", name="typegroupe_show")
     * @Method("GET")
     */
    public function showAction(TypeGroupe $typeGroupe)
    {
        $deleteForm = $this->createDeleteForm($typeGroupe);

        return $this->render('typegroupe/show.html.twig', array(
            'typeGroupe' => $typeGroupe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeGroupe entity.
     *
     * @Route("/{id}/edit", name="typegroupe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypeGroupe $typeGroupe)
    {
        $deleteForm = $this->createDeleteForm($typeGroupe);
        $editForm = $this->createForm('AppBundle\Form\TypeGroupeType', $typeGroupe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typegroupe_edit', array('id' => $typeGroupe->getId()));
        }

        return $this->render('typegroupe/edit.html.twig', array(
            'typeGroupe' => $typeGroupe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeGroupe entity.
     *
     * @Route("/{id}/delete", name="typegroupe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypeGroupe $typeGroupe)
    {
        $form = $this->createDeleteForm($typeGroupe);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeGroupe);
            $em->flush();
        }

        return $this->redirectToRoute('typegroupe_index');


    }

    /**
     * Creates a form to delete a typeGroupe entity.
     *
     * @param TypeGroupe $typeGroupe The typeGroupe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeGroupe $typeGroupe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typegroupe_delete', array('id' => $typeGroupe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

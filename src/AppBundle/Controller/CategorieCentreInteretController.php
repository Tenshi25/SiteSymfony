<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CategorieCentreInteret;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Categoriecentreinteret controller.
 *
 * @Route("admin/categoriecentreinteret")
 */
class CategorieCentreInteretController extends Controller
{
    /**
     * Lists all categorieCentreInteret entities.
     *
     * @Route("/", name="admin_categoriecentreinteret_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieCentreInterets = $em->getRepository('AppBundle:CategorieCentreInteret')->findAll();

        return $this->render('categoriecentreinteret/index.html.twig', array(
            'categorieCentreInterets' => $categorieCentreInterets,
        ));
    }

    /**
     * Creates a new categorieCentreInteret entity.
     *
     * @Route("/new", name="admin_categoriecentreinteret_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categorieCentreInteret = new Categoriecentreinteret();
        $form = $this->createForm('AppBundle\Form\CategorieCentreInteretType', $categorieCentreInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieCentreInteret);
            $em->flush();

            return $this->redirectToRoute('admin_categoriecentreinteret_show', array('id' => $categorieCentreInteret->getId()));
        }

        return $this->render('categoriecentreinteret/new.html.twig', array(
            'categorieCentreInteret' => $categorieCentreInteret,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorieCentreInteret entity.
     *
     * @Route("/{id}", name="admin_categoriecentreinteret_show")
     * @Method("GET")
     */
    public function showAction(CategorieCentreInteret $categorieCentreInteret)
    {
        $deleteForm = $this->createDeleteForm($categorieCentreInteret);

        return $this->render('categoriecentreinteret/show.html.twig', array(
            'categorieCentreInteret' => $categorieCentreInteret,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorieCentreInteret entity.
     *
     * @Route("/{id}/edit", name="admin_categoriecentreinteret_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategorieCentreInteret $categorieCentreInteret)
    {
        $deleteForm = $this->createDeleteForm($categorieCentreInteret);
        $editForm = $this->createForm('AppBundle\Form\CategorieCentreInteretType', $categorieCentreInteret);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_categoriecentreinteret_edit', array('id' => $categorieCentreInteret->getId()));
        }

        return $this->render('categoriecentreinteret/edit.html.twig', array(
            'categorieCentreInteret' => $categorieCentreInteret,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorieCentreInteret entity.
     *
     * @Route("/{id}/delete", name="admin_categoriecentreinteret_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CategorieCentreInteret $categorieCentreInteret)
    {
        $form = $this->createDeleteForm($categorieCentreInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieCentreInteret);
            $em->flush();
        }

        return $this->redirectToRoute('admin_categoriecentreinteret_index');
    }

    /**
     * Creates a form to delete a categorieCentreInteret entity.
     *
     * @param CategorieCentreInteret $categorieCentreInteret The categorieCentreInteret entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategorieCentreInteret $categorieCentreInteret)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_categoriecentreinteret_delete', array('id' => $categorieCentreInteret->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

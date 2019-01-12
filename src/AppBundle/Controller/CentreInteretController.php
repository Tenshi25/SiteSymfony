<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentreInteret;
use AppBundle\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Centreinteret controller.
 *
 * @Route("admin/centreinteret")
 */
class CentreInteretController extends Controller
{
    /**
     * Lists all centreInteret entities.
     *
     * @Route("/", name="admin_centreinteret_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $centreInterets = $em->getRepository('AppBundle:CentreInteret')->findAll();

        return $this->render('centreinteret/index.html.twig', array(
            'centreInterets' => $centreInterets,
        ));
    }

    /**
     * Creates a new centreInteret entity.
     *
     * @Route("/new", name="admin_centreinteret_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $centreInteret = new Centreinteret();
        $form = $this->createForm('AppBundle\Form\CentreInteretType', $centreInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($centreInteret);
            $em->flush();

            return $this->redirectToRoute('admin_centreinteret_show', array('id' => $centreInteret->getId()));
        }

        return $this->render('centreinteret/new.html.twig', array(
            'centreInteret' => $centreInteret,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a centreInteret entity.
     *
     * @Route("/{id}", name="admin_centreinteret_show")
     * @Method("GET")
     */
    public function showAction(CentreInteret $centreInteret)
    {
        $deleteForm = $this->createDeleteForm($centreInteret);

        return $this->render('centreinteret/show.html.twig', array(
            'centreInteret' => $centreInteret,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Finds and displays a centreInteret entity.
     *
     * @Route("/{id}/centre d'interêt", name="centreinteret_voirPlus")
     * @Method("GET")
     */
    public function voirPlusAction(CentreInteret $centreInteret)
    {
        /*$em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('p')
            ->from('photo', 'p')
            ->where('p.id = :id_photo')
            ->orderBy('p.titre', 'ASC')
            ->setParameter('id_photo', $centreInteret->getId());

        $query = $qb->getQuery();*/
        //$listePhoto = $query->getResult();
        return $this->render('centreinteret/page.html.twig', array(
            'centreInteret' => $centreInteret,
            'listePhoto' => $centreInteret->getPhotos(),
        ));
    }

    /**
     * Displays a form to edit an existing centreInteret entity.
     *
     * @Route("/{id}/edit", name="admin_centreinteret_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CentreInteret $centreInteret)
    {
        $deleteForm = $this->createDeleteForm($centreInteret);
        $editForm = $this->createForm('AppBundle\Form\CentreInteretType', $centreInteret);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_centreinteret_edit', array('id' => $centreInteret->getId()));
        }

        return $this->render('centreinteret/edit.html.twig', array(
            'centreInteret' => $centreInteret,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a centreInteret entity.
     *
     * @Route("/{id}/delete", name="admin_centreinteret_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CentreInteret $centreInteret)
    {
        $form = $this->createDeleteForm($centreInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($centreInteret);
            $em->flush();
        }

        return $this->redirectToRoute('admin_centreinteret_index');
    }

    /**
     * Creates a form to delete a centreInteret entity.
     *
     * @param CentreInteret $centreInteret The centreInteret entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CentreInteret $centreInteret)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_centreinteret_delete', array('id' => $centreInteret->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ThemePage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Themepage controller.
 *
 * @Route("admin/themepage")
 */
class ThemePageController extends Controller
{
    /**
     * Lists all themePage entities.
     *
     * @Route("/", name="admin_themepage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $themePages = $em->getRepository('AppBundle:ThemePage')->findAll();

        return $this->render('themepage/index.html.twig', array(
            'themePages' => $themePages,
        ));
    }

    /**
     * Creates a new themePage entity.
     *
     * @Route("/new", name="admin_themepage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $themePage = new Themepage();
        $form = $this->createForm('AppBundle\Form\ThemePageType', $themePage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($themePage);
            $em->flush();

            return $this->redirectToRoute('admin_themepage_show', array('id' => $themePage->getId()));
        }

        return $this->render('themepage/new.html.twig', array(
            'themePage' => $themePage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a themePage entity.
     *
     * @Route("/{id}", name="admin_themepage_show")
     * @Method("GET")
     */
    public function showAction(ThemePage $themePage)
    {
        $deleteForm = $this->createDeleteForm($themePage);

        return $this->render('themepage/show.html.twig', array(
            'themePage' => $themePage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing themePage entity.
     *
     * @Route("/{id}/edit", name="admin_themepage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ThemePage $themePage)
    {
        $deleteForm = $this->createDeleteForm($themePage);
        $editForm = $this->createForm('AppBundle\Form\ThemePageType', $themePage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_themepage_edit', array('id' => $themePage->getId()));
        }

        return $this->render('themepage/edit.html.twig', array(
            'themePage' => $themePage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a themePage entity.
     *
     * @Route("/{id}", name="admin_themepage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ThemePage $themePage)
    {
        $form = $this->createDeleteForm($themePage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($themePage);
            $em->flush();
        }

        return $this->redirectToRoute('admin_themepage_index');
    }

    /**
     * Creates a form to delete a themePage entity.
     *
     * @param ThemePage $themePage The themePage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ThemePage $themePage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_themepage_delete', array('id' => $themePage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

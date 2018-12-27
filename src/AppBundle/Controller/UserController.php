<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;


/**
 * User controller.
 *
 * @Route("/admin/user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $this->denyAccessUnlessGranted('ROLE_USER');
        /*$em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();*/
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $formNew = $this->createForm('AppBundle\Form\UserType', $user);

        $formNew->handleRequest($request);
        $user =$formNew->getdata();
        $erreur=3;
        $erreurUti=3;
        if($formNew->isSubmitted()&& $formNew->isValid()) {
            $user->setUsername($formNew["username"]->getData());
            $user->setPassword('test');
            //var_dump($formNew["username"]->getData());
            $exists = $userManager->findUserBy(array('email' => $user->getEmail()));
            if ($exists instanceof User) {

                $erreur=0;
                //throw new HttpException(409, 'Email already taken');
            }else
                {
                    $erreur=1;
                }
            $exists = $userManager->findUserBy(array('username' => $user->getUsername()));
            if ($exists instanceof User) {

                $erreurUti=0;
                //throw new HttpException(409, 'Email already taken');
            }else
            {
                if($erreur !=0){

                    $erreurUti=1;
                    $userManager->updateUser($user);
                }
            }


        }

            return $this->render('user/new.html.twig', array(
                'user' => $user,
                'form' => $formNew->createView(),
                'error'=> $erreur,
                'errorUti'=> $erreurUti,
            ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $id)
    {
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm('AppBundle\Form\UserType', $id);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($id);
            $em->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $id,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}/del", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {

        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //var_dump($form);
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            //$this->get('session')->getFlashBag()->add('msg', array('alert' => 'success', 'message' => 'Utilisateur supprimé avec succès!'));

        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */

        private function createDeleteForm(\FOS\UserBundle\Model\User $user)//\FOS\UserBundle\Model\User $user)
        {
            $this->denyAccessUnlessGranted('ROLE_USER');

            return $this->createFormBuilder()
                ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
                ->setMethod('DELETE')
                ->getForm();
        }
    /**
     * Displays a form to change password of an existing User entity.
     * @Route("/{id}/password/", name="admin_user_password")
     * @Method({"GET", "POST"})
     */
    public function changePasswordAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $formFactory = $this->container->get('fos_user.change_password.form.factory');

        $form = $formFactory->createForm();
        $form->remove('current_password');
        $form->setData($entity);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $userManager = $this->container->get('fos_user.user_manager');
                $userManager->updateUser($entity);

                return $this->redirect($this->generateUrl('admin_user'));
            }
        }

        return array(
            'entity'      => $entity,
            'form'   => $form->createView(),
        );
    }

}

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

        //$form->submit($request);
        $formNew->handleRequest($request);
        $user =$formNew->getdata();
        //var_dump($form->getdata());
        //var_dump($form->get('username'));
        //$user->setUsername($request->get('username'));
        /*$user->setUsername('john4');
        $user->setEmail('john6.doe@example.com');

        $userManager->updateUser($user);*/
        //var_dump($form->getdata());
        if($formNew->isSubmitted()&& $formNew->isValid()) {
            $user->setUsername($formNew["username"]->getData());
            $user->setPassword('test');
            var_dump($formNew["username"]->getData());
            $exists = $userManager->findUserBy(array('email' => $user->getEmail()));
            if ($exists instanceof User) {
                throw new HttpException(409, 'Email already taken');
            }
            $userManager->updateUser($user);
        }

            return $this->render('user/new.html.twig', array(
                'user' => $user,
                'form' => $formNew->createView(),
            ));
//
        /*$this->denyAccessUnlessGranted('ROLE_USER');
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        //$form = $this->createForm('vendor\friendsofsymfony\user-bundle\Form\Type\RegistrationFormType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }*/

        /*  $user = new User();
            $form = $this->createForm(new RegistrationType(), $user);
            $form->submit($request);
            if($form->isValid()) {
                $userManager = $this->get('fos_user.user_manager');
                $exists = $userManager->findUserBy(array('email' => $user->getEmail()));
                if ($exists instanceof User) {
                    throw new HttpException(409, 'Email already taken');
                }
                $userManager->updateUser($user);
             }

         * */
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
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(\FOS\UserBundle\Model\User $user)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

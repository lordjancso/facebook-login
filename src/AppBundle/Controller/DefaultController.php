<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/home.html.twig', array(
            'user' => $this->getUser()
        ));
    }

    public function homeAction(Request $request)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_index');
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $em = $this->getDoctrine()->getManager('default');

        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error
        ));
    }
}

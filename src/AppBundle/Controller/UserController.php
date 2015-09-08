<?php

namespace AppBundle\Controller;

use AppBundle\Form\SettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('default');

        $user = $this->getUser();
        $form = $this->createForm(new SettingsType(), $user);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('user/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}

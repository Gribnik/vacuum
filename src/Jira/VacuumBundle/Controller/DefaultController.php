<?php

namespace Jira\VacuumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jira\VacuumBundle\Entity\Login;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return new Response('Hello world');
    }

    public function loginAction()
    {
        $login = new Login();
        $form = $this->createFormBuilder($login)
            ->setAction($this->generateUrl('login'))
            ->add('login', 'text')
            ->add('password', 'text')
            ->add('go', 'submit')
            ->getForm();
        return $this->render('JiraVacuumBundle:Login:login.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function loginProcessAction(Request $request)
    {
        $login = new Login();

        $form = $this->createFormBuilder($login)
            ->add('login', 'text')
            ->add('password', 'text')
            ->add('go', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \Requester $requester */
            $requester = $this->get("requester");
            $requester->loginRequest($request);
            return $this->redirect($this->generateUrl('index'));
        } else {
            return $this->render('JiraVacuumBundle:Login:login.html.twig', array(
                'form' => $form->createView()
            ));
        }
    }
}

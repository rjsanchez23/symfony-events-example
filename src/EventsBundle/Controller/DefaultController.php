<?php

namespace EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $greetService = $this->get("events.greet.service");

        return $this->render('EventsBundle:Default:index.html.twig', array('greet' => $greetService->greet()));
    }

    public function helloAction($name)
    {
        $greetService = $this->get("events.greet.service");

        return $this->render('EventsBundle:Default:index.html.twig', array('greet' => $greetService->greet($name)));
    }

    public function exceptionAction()
    {
       throw new Exception("Example exception");
    }

    public function viewAction()
    {
        echo "no return no controller </br>";
    }
}

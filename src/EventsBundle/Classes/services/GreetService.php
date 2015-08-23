<?php

namespace EventsBundle\Classes\services;


use EventsBundle\Classes\events\GreetEvent;
use EventsBundle\Classes\events\GreetEvents;
use EventsBundle\Classes\Model\Greet;
use EventsBundle\Classes\principal\HelloWorld;
use Symfony\Component\DependencyInjection\ContainerAware;

class GreetService extends ContainerAware
{


    private $helloWorld;

    public function __construct(HelloWorld $helloWorld)
    {
        $this->helloWorld = $helloWorld;
    }


    public function greet($name = "World")
    {
        $message = $this->helloWorld->greet($name);
        $this->dispatchCommentEvent($message);
        return $message;
    }

    private function dispatchCommentEvent($message)
    {
        $comment = new Greet();
        $comment->message = $message;
        $commentEvent = new GreetEvent($comment);
        $this->container->get('event_dispatcher')->dispatch(GreetEvents::SUBMITTED, $commentEvent);
    }


}
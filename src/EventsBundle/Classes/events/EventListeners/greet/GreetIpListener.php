<?php

namespace EventsBundle\Classes\events\EventListeners\greet;

use EventsBundle\Classes\events\GreetEvent;
use Symfony\Component\HttpFoundation\RequestStack;


class GreetIpListener
{
    protected $request;

    public function __construct(RequestStack $request)
    {
        $this->request = $request->getCurrentRequest();
    }

    public function onGreetSubmitted(GreetEvent $event)
    {
        $greet = $event->getGreet();
        $greet->ip = $this->request->getClientIp();
    }

}
<?php


namespace EventsBundle\Classes\events\EventListeners\greet;

use EventsBundle\Classes\events\GreetEvent;
use EventsBundle\Classes\library\LogWriter;

class GreetLogListener
{
    private $logWriter;

    public function __construct(LogWriter $logWriter)
    {
        $this->logWriter = $logWriter;

    }

    public function onGreetSubmitted(GreetEvent $event)
    {
        $greet = $event->getGreet();
        $this->logWriter->log("$greet->message | $greet->ip");

    }
}
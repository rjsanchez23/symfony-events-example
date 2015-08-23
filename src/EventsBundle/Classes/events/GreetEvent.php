<?php


namespace EventsBundle\Classes\events;

use EventsBundle\Classes\Model\Greet;
use Symfony\Component\EventDispatcher\Event;

class GreetEvent extends Event
{
    private $greet;

    public function __construct(Greet $greet)
    {
        $this->greet = $greet;
    }

    public function getGreet()
    {
        return $this->greet;
    }
}
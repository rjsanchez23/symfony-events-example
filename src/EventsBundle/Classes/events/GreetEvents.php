<?php


namespace EventsBundle\Classes\events;

final class GreetEvents
{
    /**
     * This event occurs when a comment is submitted
     *
     * The event listener receives an
     * EventsBundle\Classes\events\GreetEvent instance.
     *
     * @var string
     */
    const SUBMITTED = 'greet.submitted';
}
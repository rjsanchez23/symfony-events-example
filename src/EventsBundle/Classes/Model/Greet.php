<?php


namespace EventsBundle\Classes\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Greet
{

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 6,
     *     max = 300
     * )
     */
    public $message;

    public $ip;
}
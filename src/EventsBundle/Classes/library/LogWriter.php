<?php

namespace EventsBundle\Classes\library;


use Symfony\Component\HttpKernel\Log\LoggerInterface;

class LogWriter
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function log($message)
    {
        $this->logger->info($message);
    }
}
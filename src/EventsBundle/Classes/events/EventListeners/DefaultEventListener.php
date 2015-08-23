<?php


namespace EventsBundle\Classes\events\EventListeners;


use EventsBundle\Classes\library\LogWriter;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;

class DefaultEventListener implements EventSubscriberInterface
{
    private $logWriter;

    /**
     * DefaultEventListener constructor.
     */
    public function __construct(LogWriter $logWriter)
    {
        $this->logWriter = $logWriter;

    }


    /**
     * @param GetResponseEvent $event
     * Este evento se lanza nada más empieza a manejarse la petición, lo que permite crear una respuesta antes de que se ejecute otro código del framework.
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        echo "Event on request </br>";


    }

    /**
     * @param GetResponseForExceptionEvent $event
     * Este evento se lanza cuando aparece una excepción no capturada y permite crear una respuesta para una excepción lanzada o modificar la excepción.
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        echo "Event on exception </br>";

    }

    /**
     * @param GetResponseForControllerResultEvent $event
     * Este evento se lanza cuando lo que devuelve un controller no es una instancia de Response permitiendo crear una respuesta con lo devuelto por el controller
     * @return Response
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $event->setResponse(new Response("Event on View </br>", 501));


    }
    /**
     * @param FilterControllerEvent $event
     * Este evento se lanza una vez que se ha encontrado un controller para manejar la petición, en este punto se podría cambiar el controlador que la va a manejar.
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        echo "Event on controller </br>";
    }

    /**
     * @param FilterResponseEvent $event
     * Este evento se lanza cuando se crea la respuesta para una petición dada y permite modificar el contenido de esa respuesta.
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        echo "Event on response </br>";
    }

    /**
     * @param PostResponseEvent $event
     * Este evento se lanza cuando ya se ha enviado la respuesta, permitiendo realizar trabajos pesados.
     */
    public function onKernelTerminate(PostResponseEvent $event)
    {
        $this->logWriter->log("Event on terminate");
    }


    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
            'kernel.request'    => 'onKernelRequest',
            'kernel.response'   => 'onKernelResponse',
            'kernel.view'       => 'onKernelView',
            'kernel.exception'  => 'onKernelException',
            'kernel.terminate'  => 'onKernelTerminate'
        ];

    }
}
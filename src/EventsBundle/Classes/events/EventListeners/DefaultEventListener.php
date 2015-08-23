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
     * Este evento se lanza nada m�s empieza a manejarse la petici�n, lo que permite crear una respuesta antes de que se ejecute otro c�digo del framework.
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        echo "Event on request </br>";


    }

    /**
     * @param GetResponseForExceptionEvent $event
     * Este evento se lanza cuando aparece una excepci�n no capturada y permite crear una respuesta para una excepci�n lanzada o modificar la excepci�n.
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
     * Este evento se lanza una vez que se ha encontrado un controller para manejar la petici�n, en este punto se podr�a cambiar el controlador que la va a manejar.
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        echo "Event on controller </br>";
    }

    /**
     * @param FilterResponseEvent $event
     * Este evento se lanza cuando se crea la respuesta para una petici�n dada y permite modificar el contenido de esa respuesta.
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
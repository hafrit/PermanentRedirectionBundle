<?php
/**
 * Copyright (c) 12.2016.
 * Licence GPL/GNU
 * @Author: Hamdi Afrit <hamdi.afrit@gmail.com>
 */

namespace hafrit\PermanentRedirectionBundle\Listeners;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class RouteListener
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Router
     */
    protected $router;

    /**
     * Constructor
     *
     * @param Container $container
     */
    public function __construct(Container $container, Router $router)
    {
        $this->container = $container;
        $this->router    = $router;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();

        if ($this->container->getParameter('hafrit_permanent_redirection.enable')) {
            return $this->checkExistRedirection($event, $request);
        }
    }

    /**
     * @param FilterControllerEvent $event
     * @param Request $request
     *
     * @return RedirectResponse
     */
    private function checkExistRedirection(FilterControllerEvent $event, Request $request)
    {
        foreach ($this->container->getParameter('hafrit_permanent_redirection.redirection_lists') as $redirection) {
            if ($redirection['source'] === $request->attributes->get('_route')) {
                return $this->createRedirection($event, $request, $redirection);
            }
        }
    }

    /**
     * @param FilterControllerEvent $event
     * @param Request $request
     * @param array   $redirection
     *
     * @see UrlGeneratorInterface
     */
    private function createRedirection(FilterControllerEvent $event, Request $request, array $redirection)
    {
        $redirectUrl = $redirection['target'];
        //if keepParameters true than redirect to target route with same route parameters
        $routeParameters = $redirection['keepParameters'] ? $request->attributes->get('_route_params') : [];

        $event->setController(function() use ($redirectUrl, $redirection, $routeParameters) {
            return new RedirectResponse(
                $this->router->generate($redirection['target'], $routeParameters, $redirection['referenceType']),
                $redirection['status']
            );
        });
    }
}

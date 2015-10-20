<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Bundle\WebBundle\Controller;

use Kreta\Bundle\UserBundle\Event\CookieEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class DefaultController.
 *
 * @package Kreta\Bundle\WebBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        if ($this->getUser() instanceof UserInterface) {
            $event = $this->get('event_dispatcher')->dispatch(
                CookieEvent::NAME, new CookieEvent($request->getSession())
            );

            return $this->dashboardAction($event->getResponse());
        }

        return $this->render('KretaWebBundle::index.html.twig');
    }

    /**
     * Dashboard action.
     *
     * @param \Symfony\Component\HttpFoundation\Response $response The response
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction(Response $response)
    {
        return $this->render('KretaWebBundle::app.html.twig', [], $response);
    }
}

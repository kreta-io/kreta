<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Component\Notification\NotifiableEvent;

use Kreta\Component\Issue\Model\Interfaces\IssueInterface;
use Kreta\Component\Notification\Factory\NotificationFactory;
use Kreta\Component\Notification\NotifiableEvent\Interfaces\NotifiableEventInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class IssueEvents.
 *
 * @package Kreta\Component\Notification\NotifiableEvent
 */
class IssueEvents implements NotifiableEventInterface
{
    const EVENT_ISSUE_NEW = 'issue_new';

    /**
     * Array which contains the supported events.
     *
     * @var array
     */
    protected $supportedEvents = ['postPersist'];

    /**
     * The notification factory.
     *
     * @var \Kreta\Component\Notification\Factory\NotificationFactory
     */
    protected $notificationFactory;

    /**
     * The router.
     *
     * @var \Symfony\Component\Routing\RouterInterface
     */
    protected $router;

    /**
     * Constructor.
     *
     * @param \Kreta\Component\Notification\Factory\NotificationFactory $notificationFactory The notification factory
     * @param \Symfony\Component\Routing\RouterInterface                $router              The router
     */
    public function __construct(NotificationFactory $notificationFactory, RouterInterface $router)
    {
        $this->notificationFactory = $notificationFactory;
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEvent($event, $object)
    {
        return $object instanceof IssueInterface && in_array($event, $this->supportedEvents);
    }

    /**
     * {@inheritdoc}
     */
    public function getNotifications($event, $object)
    {
        $notifications = [];
        switch ($event) {
            case 'postPersist':
                if ($object->getAssignee() != $object->getReporter()) {
                    $url = $this->router->generate(
                        'get_issue', ['issueId' => $object->getId()]
                    );
                    $notification = $this->notificationFactory->create();
                    $notification
                        ->setProject($object->getProject())
                        ->setTitle($object->getTitle())
                        ->setDescription($object->getDescription())
                        ->setType(self::EVENT_ISSUE_NEW)
                        ->setResourceUrl($url)
                        ->setWebUrl($url)
                        ->setUser($object->getAssignee());
                    $notifications[] = $notification;
                }
                break;
        }

        return $notifications;
    }
}

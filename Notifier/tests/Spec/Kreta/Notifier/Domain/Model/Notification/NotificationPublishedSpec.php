<?php

/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Spec\Kreta\Notifier\Domain\Model\Notification;

use Kreta\Notifier\Domain\Model\Notification\NotificationBody;
use Kreta\Notifier\Domain\Model\Notification\NotificationId;
use Kreta\Notifier\Domain\Model\Notification\NotificationOwner;
use Kreta\Notifier\Domain\Model\Notification\NotificationPublished;
use Kreta\Notifier\Domain\Model\Notification\NotificationStatus;
use Kreta\SharedKernel\Domain\Model\DomainEvent;
use PhpSpec\ObjectBehavior;

class NotificationPublishedSpec extends ObjectBehavior
{
    function it_should_be_created(NotificationId $id, NotificationOwner $owner, NotificationBody $body)
    {
        $this->beConstructedWith($id, $owner, $body);
        $this->shouldHaveType(NotificationPublished::class);
        $this->shouldImplement(DomainEvent::class);
        $this->status()->shouldReturnAnInstanceOf(NotificationStatus::class);
        $this->occurredOn()->shouldReturnAnInstanceOf(\DateTimeInterface::class);
        $this->id()->shouldReturn($id);
        $this->body()->shouldReturn($body);
        $this->owner()->shouldReturn($owner);
    }
}

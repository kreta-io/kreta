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

use Kreta\Notifier\Domain\Model\Notification\NotificationId;
use Kreta\Notifier\Domain\Model\Notification\NotificationMarkedAsRead;
use Kreta\SharedKernel\Domain\Model\DomainEvent;
use PhpSpec\ObjectBehavior;

class NotificationMarkedAsReadSpec extends ObjectBehavior
{
    function it_should_be_created(NotificationId $id)
    {
        $this->beConstructedWith($id);
        $this->shouldHaveType(NotificationMarkedAsRead::class);
        $this->shouldImplement(DomainEvent::class);
        $this->id()->shouldReturn($id);
        $this->occurredOn()->shouldReturnAnInstanceOf(\DateTimeInterface::class);
    }
}

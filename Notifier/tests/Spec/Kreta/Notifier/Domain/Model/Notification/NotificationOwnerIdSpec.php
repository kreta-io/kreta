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

use Kreta\Notifier\Domain\Model\Notification\NotificationOwnerId;
use Kreta\SharedKernel\Domain\Model\Identity\Id;
use PhpSpec\ObjectBehavior;

class NotificationOwnerIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NotificationOwnerId::class);
    }

    function it_extends_id()
    {
        $this->shouldHaveType(Id::class);
    }

    function it_generates()
    {
        $this->beConstructedGenerate();

        $this::generate()->shouldReturnAnInstanceOf(NotificationOwnerId::class);
    }
}

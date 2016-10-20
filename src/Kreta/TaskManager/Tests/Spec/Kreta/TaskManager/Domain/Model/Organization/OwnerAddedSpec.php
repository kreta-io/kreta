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

namespace Spec\Kreta\TaskManager\Domain\Model\Organization;

use Kreta\SharedKernel\Domain\Model\DomainEvent;
use Kreta\TaskManager\Domain\Model\Organization\OrganizationId;
use Kreta\TaskManager\Domain\Model\Organization\OwnerAdded;
use Kreta\TaskManager\Domain\Model\Organization\OwnerId;
use Kreta\TaskManager\Domain\Model\User\UserId;
use PhpSpec\ObjectBehavior;

class OwnerAddedSpec extends ObjectBehavior
{
    function let(OwnerId $ownerId, UserId $userId, OrganizationId $organizationId)
    {
        $this->beConstructedWith($ownerId, $userId, $organizationId);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OwnerAdded::class);
        $this->shouldImplement(DomainEvent::class);
    }

    function it_can_be_created(OwnerId $ownerId, UserId $userId, OrganizationId $organizationId)
    {
        $this->occurredOn()->shouldReturnAnInstanceOf(\DateTimeInterface::class);
        $this->organizationId()->shouldReturn($organizationId);
        $this->ownerId()->shouldReturn($ownerId);
        $this->userId()->shouldReturn($userId);
    }
}

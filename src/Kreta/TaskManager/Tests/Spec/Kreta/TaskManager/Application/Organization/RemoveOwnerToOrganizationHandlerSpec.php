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

namespace Spec\Kreta\TaskManager\Application\Organization;

use Kreta\TaskManager\Application\Organization\RemoveOwnerToOrganizationCommand;
use Kreta\TaskManager\Application\Organization\RemoveOwnerToOrganizationHandler;
use Kreta\TaskManager\Domain\Model\Organization\Organization;
use Kreta\TaskManager\Domain\Model\Organization\OrganizationDoesNotExistException;
use Kreta\TaskManager\Domain\Model\Organization\OrganizationId;
use Kreta\TaskManager\Domain\Model\Organization\OrganizationRepository;
use Kreta\TaskManager\Domain\Model\Organization\UnauthorizedOrganizationActionException;
use Kreta\TaskManager\Domain\Model\User\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoveOwnerToOrganizationHandlerSpec extends ObjectBehavior
{
    function let(OrganizationRepository $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RemoveOwnerToOrganizationHandler::class);
    }

    function it_removes_owner_to_organization(
        RemoveOwnerToOrganizationCommand $command,
        OrganizationRepository $repository,
        Organization $organization
    ) {
        $organizationId = OrganizationId::generate('organization-id');

        $command->organizationId()->shouldBeCalled()->willReturn('organization-id');
        $repository->organizationOfId($organizationId)->shouldBeCalled()->willReturn($organization);
        $command->removerId()->shouldBeCalled()->willReturn('remover-id');
        $organization->isOwner(UserId::generate('remover-id'))->shouldBeCalled()->willReturn(true);
        $command->userId()->shouldBeCalled()->willReturn('user-id');
        $organization->removeOwner(UserId::generate('user-id'))->shouldBeCalled();
        $repository->persist(Argument::type(Organization::class))->shouldBeCalled();
        $this->__invoke($command);
    }

    function it_does_not_remove_owner_to_organization_because_organization_does_not_exist(
        RemoveOwnerToOrganizationCommand $command,
        OrganizationRepository $repository
    ) {
        $command->organizationId()->shouldBeCalled()->willReturn('organization-id');
        $repository->organizationOfId(
            OrganizationId::generate('organization-id')
        )->shouldBeCalled()->willReturn(null);
        $this->shouldThrow(OrganizationDoesNotExistException::class)->during__invoke($command);
    }

    function it_does_not_remove_owner_to_organization_because_it_is_not_allowed(
        RemoveOwnerToOrganizationCommand $command,
        OrganizationRepository $repository,
        Organization $organization
    ) {
        $organizationId = OrganizationId::generate('organization-id');

        $command->organizationId()->shouldBeCalled()->willReturn('organization-id');
        $repository->organizationOfId($organizationId)->shouldBeCalled()->willReturn($organization);
        $command->removerId()->shouldBeCalled()->willReturn('remover-id');
        $organization->isOwner(UserId::generate('remover-id'))->shouldBeCalled()->willReturn(false);
        $this->shouldThrow(UnauthorizedOrganizationActionException::class)->during__invoke($command);
    }
}

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

namespace Spec\Kreta\TaskManager\Application\Project\Task;

use Kreta\TaskManager\Application\Project\Task\CreateTaskCommand;
use Kreta\TaskManager\Application\Project\Task\CreateTaskHandler;
use Kreta\TaskManager\Domain\Model\Organization\Member;
use Kreta\TaskManager\Domain\Model\Organization\MemberId;
use Kreta\TaskManager\Domain\Model\Organization\Organization;
use Kreta\TaskManager\Domain\Model\Organization\OrganizationId;
use Kreta\TaskManager\Domain\Model\Organization\OrganizationRepository;
use Kreta\TaskManager\Domain\Model\Project\Project;
use Kreta\TaskManager\Domain\Model\Project\ProjectDoesNotExistException;
use Kreta\TaskManager\Domain\Model\Project\ProjectId;
use Kreta\TaskManager\Domain\Model\Project\ProjectRepository;
use Kreta\TaskManager\Domain\Model\Project\Task\Task;
use Kreta\TaskManager\Domain\Model\Project\Task\TaskAlreadyExistsException;
use Kreta\TaskManager\Domain\Model\Project\Task\TaskAndTaskParentCannotBeTheSameException;
use Kreta\TaskManager\Domain\Model\Project\Task\TaskId;
use Kreta\TaskManager\Domain\Model\Project\Task\TaskParentDoesNotExistException;
use Kreta\TaskManager\Domain\Model\Project\Task\TaskRepository;
use Kreta\TaskManager\Domain\Model\Project\Task\UnauthorizedTaskActionException;
use Kreta\TaskManager\Domain\Model\User\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateTaskHandlerSpec extends ObjectBehavior
{
    function let(
        TaskRepository $repository,
        ProjectRepository $projectRepository,
        OrganizationRepository $organizationRepository
    ) {
        $this->beConstructedWith($repository, $projectRepository, $organizationRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateTaskHandler::class);
    }

    function it_creates_an_task(
        CreateTaskCommand $command,
        TaskRepository $repository,
        ProjectRepository $projectRepository,
        OrganizationRepository $organizationRepository,
        Project $project,
        OrganizationId $organizationId,
        Organization $organization,
        Task $parent,
        ProjectId $projectId,
        Member $member,
        Member $member2,
        MemberId $memberId,
        MemberId $memberId2
    ) {
        $command->projectId()->shouldBeCalled()->willReturn('project-id');
        $command->taskId()->shouldBeCalled()->willReturn('task-id');
        $command->parentId()->shouldBeCalled()->willReturn('parent-id');
        $repository->taskOfId(TaskId::generate('task-id'))->shouldBeCalled()->willReturn(null);
        $projectRepository->projectOfId(ProjectId::generate('project-id'))->shouldBeCalled()->willReturn($project);
        $project->organizationId()->shouldBeCalled()->willReturn($organizationId);
        $organizationRepository->organizationOfId($organizationId)->shouldBeCalled()->willReturn($organization);
        $command->creatorId()->shouldBeCalled()->willReturn('creator-id');
        $command->assigneeId()->shouldBeCalled()->willReturn('assignee-id');
        $organization->isMember(UserId::generate('creator-id'))->shouldBeCalled()->willReturn(true);
        $organization->isMember(UserId::generate('assignee-id'))->shouldBeCalled()->willReturn(true);
        $organization->member(UserId::generate('creator-id'))->shouldBeCalled()->willReturn($member);
        $member->id()->shouldBeCalled()->willReturn($memberId);
        $organization->member(UserId::generate('assignee-id'))->shouldBeCalled()->willReturn($member2);
        $member2->id()->shouldBeCalled()->willReturn($memberId2);
        $repository->taskOfId(TaskId::generate('parent-id'))->shouldBeCalled()->willReturn($parent);
        $command->title()->shouldBeCalled()->willReturn('Task title');
        $command->description()->shouldBeCalled()->willReturn('Task description');
        $command->priority()->shouldBeCalled()->willReturn('low');
        $project->id()->shouldBeCalled()->willReturn($projectId);
        $repository->persist(Argument::type(Task::class))->shouldBeCalled();
        $this->__invoke($command);
    }

    function it_creates_an_organization_without_task_id(
        CreateTaskCommand $command,
        TaskRepository $repository,
        ProjectRepository $projectRepository,
        OrganizationRepository $organizationRepository,
        Project $project,
        OrganizationId $organizationId,
        Organization $organization,
        Task $parent,
        ProjectId $projectId,
        Member $member,
        Member $member2,
        MemberId $memberId,
        MemberId $memberId2
    ) {
        $command->projectId()->shouldBeCalled()->willReturn('project-id');
        $command->taskId()->shouldBeCalled()->willReturn(null);
        $command->parentId()->shouldBeCalled()->willReturn('parent-id');
        $projectRepository->projectOfId(ProjectId::generate('project-id'))->shouldBeCalled()->willReturn($project);
        $project->organizationId()->shouldBeCalled()->willReturn($organizationId);
        $organizationRepository->organizationOfId($organizationId)->shouldBeCalled()->willReturn($organization);
        $command->creatorId()->shouldBeCalled()->willReturn('creator-id');
        $command->assigneeId()->shouldBeCalled()->willReturn('assignee-id');
        $organization->isMember(UserId::generate('creator-id'))->shouldBeCalled()->willReturn(true);
        $organization->isMember(UserId::generate('assignee-id'))->shouldBeCalled()->willReturn(true);
        $organization->member(UserId::generate('creator-id'))->shouldBeCalled()->willReturn($member);
        $member->id()->shouldBeCalled()->willReturn($memberId);
        $organization->member(UserId::generate('assignee-id'))->shouldBeCalled()->willReturn($member2);
        $member2->id()->shouldBeCalled()->willReturn($memberId2);
        $repository->taskOfId(TaskId::generate('parent-id'))->shouldBeCalled()->willReturn($parent);
        $command->title()->shouldBeCalled()->willReturn('Task title');
        $command->description()->shouldBeCalled()->willReturn('Task description');
        $command->priority()->shouldBeCalled()->willReturn('low');
        $project->id()->shouldBeCalled()->willReturn($projectId);
        $repository->persist(Argument::type(Task::class))->shouldBeCalled();
        $this->__invoke($command);
    }

    function it_creates_an_organization_without_parent_task(
        CreateTaskCommand $command,
        TaskRepository $repository,
        ProjectRepository $projectRepository,
        OrganizationRepository $organizationRepository,
        Project $project,
        OrganizationId $organizationId,
        Organization $organization,
        ProjectId $projectId,
        Member $member,
        Member $member2,
        MemberId $memberId,
        MemberId $memberId2
    ) {
        $command->projectId()->shouldBeCalled()->willReturn('project-id');
        $command->taskId()->shouldBeCalled()->willReturn('task-id');
        $command->parentId()->shouldBeCalled()->willReturn(null);
        $repository->taskOfId(TaskId::generate('task-id'))->shouldBeCalled()->willReturn(null);
        $projectRepository->projectOfId(ProjectId::generate('project-id'))->shouldBeCalled()->willReturn($project);
        $project->organizationId()->shouldBeCalled()->willReturn($organizationId);
        $organizationRepository->organizationOfId($organizationId)->shouldBeCalled()->willReturn($organization);
        $command->creatorId()->shouldBeCalled()->willReturn('creator-id');
        $command->assigneeId()->shouldBeCalled()->willReturn('assignee-id');
        $organization->isMember(UserId::generate('creator-id'))->shouldBeCalled()->willReturn(true);
        $organization->isMember(UserId::generate('assignee-id'))->shouldBeCalled()->willReturn(true);
        $organization->member(UserId::generate('creator-id'))->shouldBeCalled()->willReturn($member);
        $member->id()->shouldBeCalled()->willReturn($memberId);
        $organization->member(UserId::generate('assignee-id'))->shouldBeCalled()->willReturn($member2);
        $member2->id()->shouldBeCalled()->willReturn($memberId2);
        $command->title()->shouldBeCalled()->willReturn('Task title');
        $command->description()->shouldBeCalled()->willReturn('Task description');
        $command->priority()->shouldBeCalled()->willReturn('low');
        $project->id()->shouldBeCalled()->willReturn($projectId);
        $repository->persist(Argument::type(Task::class))->shouldBeCalled();
        $this->__invoke($command);
    }

    function it_does_not_create_a_task_because_task_and_parent_are_the_same(
        CreateTaskCommand $command
    ) {
        $command->taskId()->shouldBeCalled()->willReturn('task-id');
        $command->parentId()->shouldBeCalled()->willReturn('task-id');
        $this->shouldThrow(TaskAndTaskParentCannotBeTheSameException::class)->during__invoke($command);
    }

    function it_does_not_create_a_task_because_task_already_exists(
        CreateTaskCommand $command,
        TaskRepository $repository,
        Task $task
    ) {
        $command->taskId()->shouldBeCalled()->willReturn('task-id');
        $command->parentId()->shouldBeCalled()->willReturn(null);
        $repository->taskOfId(TaskId::generate('task-id'))->shouldBeCalled()->willReturn($task);
        $this->shouldThrow(TaskAlreadyExistsException::class)->during__invoke($command);
    }

    function it_does_not_create_a_task_because_project_does_not_exist(
        CreateTaskCommand $command,
        TaskRepository $repository,
        ProjectRepository $projectRepository
    ) {
        $command->projectId()->shouldBeCalled()->willReturn('project-id');
        $command->taskId()->shouldBeCalled()->willReturn('task-id');
        $command->parentId()->shouldBeCalled()->willReturn(null);
        $repository->taskOfId(TaskId::generate('task-id'))->shouldBeCalled()->willReturn(null);
        $projectRepository->projectOfId(ProjectId::generate('project-id'))->shouldBeCalled()->willReturn(null);
        $this->shouldThrow(ProjectDoesNotExistException::class)->during__invoke($command);
    }

    function it_does_not_create_a_task_because_task_creation_is_not_allowed(
        CreateTaskCommand $command,
        TaskRepository $repository,
        ProjectRepository $projectRepository,
        OrganizationRepository $organizationRepository,
        Project $project,
        OrganizationId $organizationId,
        Organization $organization
    ) {
        $command->projectId()->shouldBeCalled()->willReturn('project-id');
        $command->taskId()->shouldBeCalled()->willReturn('task-id');
        $command->parentId()->shouldBeCalled()->willReturn('parent-id');
        $repository->taskOfId(TaskId::generate('task-id'))->shouldBeCalled()->willReturn(null);
        $projectRepository->projectOfId(ProjectId::generate('project-id'))->shouldBeCalled()->willReturn($project);
        $project->organizationId()->shouldBeCalled()->willReturn($organizationId);
        $organizationRepository->organizationOfId($organizationId)->shouldBeCalled()->willReturn($organization);
        $command->creatorId()->shouldBeCalled()->willReturn('creator-id');
        $command->assigneeId()->shouldBeCalled()->willReturn('assignee-id');
        $organization->isMember(UserId::generate('creator-id'))->shouldBeCalled()->willReturn(false);
        $this->shouldThrow(UnauthorizedTaskActionException::class)->during__invoke($command);
    }

    function it_does_not_create_a_task_because_parent_task_does_not_exist(
        CreateTaskCommand $command,
        TaskRepository $repository,
        ProjectRepository $projectRepository,
        OrganizationRepository $organizationRepository,
        Project $project,
        OrganizationId $organizationId,
        Organization $organization
    ) {
        $command->projectId()->shouldBeCalled()->willReturn('project-id');
        $command->taskId()->shouldBeCalled()->willReturn('task-id');
        $command->parentId()->shouldBeCalled()->willReturn('parent-id');
        $repository->taskOfId(TaskId::generate('task-id'))->shouldBeCalled()->willReturn(null);
        $projectRepository->projectOfId(ProjectId::generate('project-id'))->shouldBeCalled()->willReturn($project);
        $project->organizationId()->shouldBeCalled()->willReturn($organizationId);
        $organizationRepository->organizationOfId($organizationId)->shouldBeCalled()->willReturn($organization);
        $command->creatorId()->shouldBeCalled()->willReturn('creator-id');
        $command->assigneeId()->shouldBeCalled()->willReturn('assignee-id');
        $organization->isMember(UserId::generate('creator-id'))->shouldBeCalled()->willReturn(true);
        $organization->isMember(UserId::generate('assignee-id'))->shouldBeCalled()->willReturn(true);
        $repository->taskOfId(TaskId::generate('parent-id'))->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(TaskParentDoesNotExistException::class)->during__invoke($command);
    }
}

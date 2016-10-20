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

use Kreta\TaskManager\Application\Project\Task\ChangeTaskProgressCommand;
use Kreta\TaskManager\Application\Project\Task\ChangeTaskProgressHandler;
use Kreta\TaskManager\Domain\Model\Organization\Organization;
use Kreta\TaskManager\Domain\Model\Organization\OrganizationId;
use Kreta\TaskManager\Domain\Model\Organization\OrganizationRepository;
use Kreta\TaskManager\Domain\Model\Project\Project;
use Kreta\TaskManager\Domain\Model\Project\ProjectId;
use Kreta\TaskManager\Domain\Model\Project\ProjectRepository;
use Kreta\TaskManager\Domain\Model\Project\Task\Task;
use Kreta\TaskManager\Domain\Model\Project\Task\TaskId;
use Kreta\TaskManager\Domain\Model\Project\Task\TaskProgress;
use Kreta\TaskManager\Domain\Model\Project\Task\TaskRepository;
use Kreta\TaskManager\Domain\Model\User\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ChangeTaskProgressHandlerSpec extends ObjectBehavior
{
    function let(
        OrganizationRepository $organizationRepository,
        ProjectRepository $projectRepository,
        TaskRepository $taskRepository
    ) {
        $this->beConstructedWith($organizationRepository, $projectRepository, $taskRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ChangeTaskProgressHandler::class);
    }

    function it_handles_task_priority_change(
        OrganizationRepository $organizationRepository,
        ProjectRepository $projectRepository,
        TaskRepository $taskRepository,
        ChangeTaskProgressCommand $command,
        Task $task,
        Project $project,
        ProjectId $projectId,
        OrganizationId $organizationId,
        Organization $organization
    ) {
        $command->id()->shouldBeCalled()->willReturn('task-id');
        $command->progress()->shouldBeCalled()->willReturn('doing');
        $command->editorId()->shouldBeCalled()->willReturn('editor-id');

        $taskRepository->taskOfId(Argument::type(TaskId::class))->shouldBeCalled()->willReturn($task);
        $task->projectId()->shouldBeCalled()->willReturn($projectId);

        $projectRepository->projectOfId($projectId)->shouldBeCalled()->willReturn($project);
        $project->organizationId()->shouldBeCalled()->willReturn($organizationId);

        $organizationRepository->organizationOfId($organizationId)->shouldBeCalled()->willReturn($organization);
        $organization->isMember(UserId::generate('editor-id'))->shouldBeCalled()->willReturn(true);

        $task->changeProgress(Argument::type(TaskProgress::class))->shouldBeCalled();

        $taskRepository->persist(Argument::type(Task::class))->shouldBeCalled();

        $this->__invoke($command);
    }
}

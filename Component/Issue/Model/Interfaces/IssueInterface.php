<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Component\Issue\Model\Interfaces;

use Finite\StatefulInterface;
use Kreta\Component\Project\Model\Interfaces\IssueTypeInterface;
use Kreta\Component\Project\Model\Interfaces\LabelInterface;
use Kreta\Component\Project\Model\Interfaces\IssuePriorityInterface;
use Kreta\Component\Project\Model\Interfaces\ProjectInterface;
use Kreta\Component\User\Model\Interfaces\UserInterface;
use Kreta\Component\Workflow\Model\Interfaces\StatusInterface;

/**
 * Interface IssueInterface.
 *
 * @package Kreta\Component\Issue\Model\Interfaces
 */
interface IssueInterface extends StatefulInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets assignee.
     *
     * @return \Kreta\Component\User\Model\Interfaces\UserInterface
     */
    public function getAssignee();

    /**
     * Sets the assignee.
     *
     * @param \Kreta\Component\User\Model\Interfaces\UserInterface $assignee The assignee
     *
     * @return $this self Object
     */
    public function setAssignee(UserInterface $assignee = null);

    /**
     * Checks that the user given is assignee.
     *
     * @param \Kreta\Component\User\Model\Interfaces\UserInterface $user The user
     *
     * @return boolean
     */
    public function isAssignee(UserInterface $user);

    /**
     * Gets child issues.
     *
     * @return \Kreta\Component\Issue\Model\Interfaces\IssueInterface[]
     */
    public function getChildren();

    /**
     * Adds child issue.
     *
     * @param \Kreta\Component\Issue\Model\Interfaces\IssueInterface $issue The child issue
     *
     * @return $this self Object
     */
    public function addChildren(IssueInterface $issue);

    /**
     * Removes child issue.
     *
     * @param \Kreta\Component\Issue\Model\Interfaces\IssueInterface $issue The child issue
     *
     * @return $this self Object
     */
    public function removeChildren(IssueInterface $issue);

    /**
     * Gets created at.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Sets created at.
     *
     * @param \DateTime $createdAt The created at.
     *
     * @return $this self Object
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Gets description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Sets description.
     *
     * @param string $description The description
     *
     * @return $this self Object
     */
    public function setDescription($description);

    /**
     * Gets labels.
     *
     * @return \Kreta\Component\Project\Model\Interfaces\LabelInterface[]
     */
    public function getLabels();

    /**
     * Adds the labels.
     *
     * @param \Kreta\Component\Project\Model\Interfaces\LabelInterface $label The label
     *
     * @return $this self Object
     */
    public function addLabel(LabelInterface $label);

    /**
     * Removes the label.
     *
     * @param \Kreta\Component\Project\Model\Interfaces\LabelInterface $label The label
     *
     * @return $this self Object
     */
    public function removeLabel(LabelInterface $label);

    /**
     * Gets numeric id.
     *
     * @return int
     */
    public function getNumericId();

    /**
     * Sets numeric id.
     *
     * @param int|null $numericId The numeric id
     *
     * @return $this self Object
     */
    public function setNumericId($numericId);

    /**
     * Gets parents issue.
     *
     * @return \Kreta\Component\Issue\Model\Interfaces\IssueInterface | null
     */
    public function getParent();

    /**
     * Sets parent issue.
     *
     * @param \Kreta\Component\Issue\Model\Interfaces\IssueInterface $issue The parent issue
     *
     * @return $this self Object
     */
    public function setParent(IssueInterface $issue);

    /**
     * Gets priority.
     *
     * @return \Kreta\Component\Project\Model\Interfaces\IssuePriorityInterface|null
     */
    public function getPriority();

    /**
     * Sets priority.
     *
     * @param \Kreta\Component\Project\Model\Interfaces\IssuePriorityInterface|null $priority The priority
     *
     * @return $this self Object
     */
    public function setPriority(IssuePriorityInterface $priority = null);

    /**
     * Gets project.
     *
     * @return \Kreta\Component\Project\Model\Interfaces\ProjectInterface
     */
    public function getProject();

    /**
     * Sets the project.
     *
     * @param \Kreta\Component\Project\Model\Interfaces\ProjectInterface $project The project
     *
     * @return $this self Object
     */
    public function setProject(ProjectInterface $project);

    /**
     * Gets reporter.
     *
     * @return \Kreta\Component\User\Model\Interfaces\UserInterface
     */
    public function getReporter();

    /**
     * Sets the reporter.
     *
     * @param \Kreta\Component\User\Model\Interfaces\UserInterface $reporter The reporter
     *
     * @return $this self Object
     */
    public function setReporter(UserInterface $reporter);

    /**
     * Checks that the user given is reporter.
     *
     * @param \Kreta\Component\User\Model\Interfaces\UserInterface $user The user
     *
     * @return boolean
     */
    public function isReporter(UserInterface $user);

    /**
     * Gets resolution.
     *
     * @return \Kreta\Component\Issue\Model\Interfaces\ResolutionInterface
     */
    public function getResolution();

    /**
     * Sets resolution.
     *
     * @param \Kreta\Component\Issue\Model\Interfaces\ResolutionInterface $resolution The resolution
     *
     * @return $this self Object
     */
    public function setResolution(ResolutionInterface $resolution);

    /**
     * Gets status.
     *
     * @return \Kreta\Component\Workflow\Model\Interfaces\StatusInterface
     */
    public function getStatus();

    /**
     * Sets status.
     *
     * @param \Kreta\Component\Workflow\Model\Interfaces\StatusInterface $status The status
     *
     * @return $this self Object
     */
    public function setStatus(StatusInterface $status);

    /**
     * Gets type.
     *
     * @return \Kreta\Component\Project\Model\Interfaces\IssueTypeInterface|null
     */
    public function getType();

    /**
     * Sets type.
     *
     * @param \Kreta\Component\Project\Model\Interfaces\IssueTypeInterface|null $type The type
     *
     * @return $this self Object
     */
    public function setType(IssueTypeInterface $type = null);

    /**
     * Gets title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Sets title.
     *
     * @param string $title The title
     *
     * @return $this self Object
     */
    public function setTitle($title);

    /**
     * Gets watchers.
     *
     * @return \Kreta\Component\User\Model\Interfaces\UserInterface[]
     */
    public function getWatchers();

    /**
     * Adds the watcher.
     *
     * @param \Kreta\Component\User\Model\Interfaces\UserInterface $watcher The watcher
     *
     * @return $this self Object
     */
    public function addWatcher(UserInterface $watcher);

    /**
     * Removes the watcher.
     *
     * @param \Kreta\Component\User\Model\Interfaces\UserInterface $watcher The watcher
     *
     * @return $this self Object
     */
    public function removeWatcher(UserInterface $watcher);

    /**
     * Checks that the user given is project participant.
     *
     * @param \Kreta\Component\User\Model\Interfaces\UserInterface $user The user
     *
     * @return boolean
     */
    public function isParticipant(UserInterface $user);

    /**
     * Doctrine's pre-persist method that allows to generate a numeric id.
     *
     * @return void
     */
    public function generateNumericId();
}

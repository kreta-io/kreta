<?php

/**
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Component\Core\Model\Interfaces;

use Finite\StatefulInterface;

/**
 * Interface IssueInterface.
 *
 * @package Kreta\Component\Core\Model\Interfaces
 */
interface IssueInterface extends StatefulInterface
{
    const PRIORITY_LOW = 0;
    const PRIORITY_MEDIUM = 1;
    const PRIORITY_HIGH = 2;
    const PRIORITY_BLOCKER = 3;

    const TYPE_BUG = 0;
    const TYPE_NEW_FEATURE = 1;
    const TYPE_IMPROVEMENT = 2;
    const TYPE_EPIC = 3;
    const TYPE_STORY = 4;

    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets assignee.
     *
     * @return \Kreta\Component\Core\Model\Interfaces\UserInterface
     */
    public function getAssignee();

    /**
     * Sets the assignee.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\UserInterface $assignee The assignee
     *
     * @return $this self Object
     */
    public function setAssignee(UserInterface $assignee);

    /**
     * Checks that the user given is assignee.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\UserInterface $user The user
     *
     * @return boolean
     */
    public function isAssignee(UserInterface $user);

    /**
     * Gets comments.
     *
     * @return \Kreta\Component\Core\Model\Interfaces\CommentInterface[]
     */
    public function getComments();

    /**
     * Adds the comment.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\CommentInterface $comment The comment
     *
     * @return $this self Object
     */
    public function addComment(CommentInterface $comment);

    /**
     * Removes the comment.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\CommentInterface $comment The comment
     *
     * @return $this self Object
     */
    public function removeComment(CommentInterface $comment);

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
     * @return \Kreta\Component\Core\Model\Interfaces\LabelInterface[]
     */
    public function getLabels();

    /**
     * Adds the labels.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\LabelInterface $label The label
     *
     * @return $this self Object
     */
    public function addLabel(LabelInterface $label);

    /**
     * Removes the label.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\LabelInterface $label The label
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
     * @param int $numericId The numeric id
     *
     * @return $this self Object
     */
    public function setNumericId($numericId);

    /**
     * Gets priority.
     *
     * @return string
     */
    public function getPriority();

    /**
     * Sets labels.
     *
     * @param string $priority The priority that can be "low", "medium", "high" or "blocking"
     *
     * @return $this self Object
     */
    public function setPriority($priority);

    /**
     * Gets reporter.
     *
     * @return \Kreta\Component\Core\Model\Interfaces\UserInterface
     */
    public function getReporter();

    /**
     * Sets the reporter.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\UserInterface $reporter The reporter
     *
     * @return $this self Object
     */
    public function setReporter(UserInterface $reporter);

    /**
     * Checks that the user given is reporter.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\UserInterface $user The user
     *
     * @return boolean
     */
    public function isReporter(UserInterface $user);

    /**
     * Gets project.
     *
     * @return \Kreta\Component\Core\Model\Interfaces\ProjectInterface
     */
    public function getProject();

    /**
     * Sets the project.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\ProjectInterface $project The project
     *
     * @return $this self Object
     */
    public function setProject(ProjectInterface $project);

    /**
     * Gets resolution.
     *
     * @return \Kreta\Component\Core\Model\Interfaces\ResolutionInterface
     */
    public function getResolution();

    /**
     * Sets resolution.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\ResolutionInterface $resolution The resolution
     *
     * @return $this self Object
     */
    public function setResolution(ResolutionInterface $resolution);

    /**
     * Gets status.
     *
     * @return \Kreta\Component\Core\Model\Interfaces\StatusInterface
     */
    public function getStatus();

    /**
     * Sets status.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\StatusInterface $status The status
     *
     * @return $this self Object
     */
    public function setStatus(StatusInterface $status);

    /**
     * Gets type.
     *
     * @return string
     */
    public function getType();

    /**
     * Sets type.
     *
     * @param string $type The type that can be "bug", "new feature", "improvement", "epic" or "story"
     *
     * @return $this self Object
     */
    public function setType($type);

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
     * @return \Kreta\Component\Core\Model\Interfaces\UserInterface[]
     */
    public function getWatchers();

    /**
     * Adds the watcher.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\UserInterface $watcher The watcher
     *
     * @return $this self Object
     */
    public function addWatcher(UserInterface $watcher);

    /**
     * Removes the watcher.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\UserInterface $watcher The watcher
     *
     * @return $this self Object
     */
    public function removeWatcher(UserInterface $watcher);

    /**
     * Checks that the user given is project participant.
     *
     * @param \Kreta\Component\Core\Model\Interfaces\UserInterface $user The user
     *
     * @return boolean
     */
    public function isParticipant(UserInterface $user);
}

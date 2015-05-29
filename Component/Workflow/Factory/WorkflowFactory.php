<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Component\Workflow\Factory;

use Kreta\Component\User\Model\Interfaces\UserInterface;
use Kreta\Component\Workflow\Model\Status;
use Kreta\Component\Workflow\Model\StatusTransition;
use Kreta\Component\Workflow\Model\Interfaces\WorkflowInterface;

/**
 * Class WorkflowFactory.
 *
 * @package Kreta\Component\Workflow\Factory
 */
class WorkflowFactory
{
    /**
     * The class name.
     *
     * @var string
     */
    protected $className;

    /**
     * Constructor.
     *
     * @param string $className The class name
     */
    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * Creates an instance of workflow.
     *
     * @param string                                               $name The name
     * @param \Kreta\Component\User\Model\Interfaces\UserInterface $user The creator
     * @param boolean                                              $load Load boolean, by default false
     *
     * @return \Kreta\Component\Workflow\Model\Interfaces\WorkflowInterface
     */
    public function create($name, UserInterface $user, $load = false)
    {
        $workflow = new $this->className();

        if ($load) {
            $workflow = $this->loadInitialStatusesAndTransitions($workflow);
        }

        return $workflow
            ->setName($name)
            ->setCreator($user);
    }

    /**
     * Loads the default statuses and transitions.
     *
     * @param \Kreta\Component\Workflow\Model\Interfaces\WorkflowInterface $workflow The workflow
     *
     * @return \Kreta\Component\Workflow\Model\Interfaces\WorkflowInterface
     */
    protected function loadInitialStatusesAndTransitions(WorkflowInterface $workflow)
    {
        $statuses = $this->createDefaultStatus();
        foreach ($statuses as $status) {
            $status->setWorkflow($workflow);
            $workflow->addStatus($status);
        }
        $transitions = $this->createDefaultTransitions($statuses);
        foreach ($transitions as $transition) {
            $workflow->addStatusTransition($transition);
        }

        return $workflow;
    }

    /**
     * Creates some default statuses to add into workflow when this is created.
     *
     * @return \Kreta\Component\Workflow\Model\Interfaces\StatusInterface[]
     */
    protected function createDefaultStatus()
    {
        $defaultStatusesNames = ['To do', 'Doing', 'Done'];
        $statuses = [];
        foreach ($defaultStatusesNames as $name) {
            $statuses[$name] = new Status($name);
        }

        $statuses['To do']->setColor('#2c3e50');
        $statuses['To do']->setType('initial');

        $statuses['Doing']->setColor('#f1c40f');

        $statuses['Done']->setColor('#1abc9c');
        $statuses['Done']->setType('final');

        return $statuses;
    }

    /**
     * Creates some default transitions to add into workflow when this is created.
     *
     * @param \Kreta\Component\Workflow\Model\Interfaces\StatusInterface[] $statuses The status
     *
     * @return \Kreta\Component\Workflow\Model\Interfaces\StatusTransitionInterface[]
     */
    protected function createDefaultTransitions($statuses)
    {
        $defaultTransitions = [
            'Start progress'  => [
                'from' => [$statuses['To do']],
                'to'   => $statuses['Doing']
            ],
            'Finish progress' => [
                'from' => [$statuses['To do'], $statuses['Doing']],
                'to'   => $statuses['Done']
            ],
            'Stop progress'   => [
                'from' => [$statuses['Doing']],
                'to'   => $statuses['To do']
            ],
            'Reopen issue'    => [
                'from' => [$statuses['Done']],
                'to'   => $statuses['Doing']
            ],
        ];

        $transitions = [];

        foreach ($defaultTransitions as $transitionName => $defaultTransition) {
            $transition = new StatusTransition($transitionName, $defaultTransition['from'], $defaultTransition['to']);

            $transitions[] = $transition;
        }

        return $transitions;
    }
}

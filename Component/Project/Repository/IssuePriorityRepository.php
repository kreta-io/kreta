<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Component\Project\Repository;

use Kreta\Component\Core\Repository\EntityRepository;
use Kreta\Component\Project\Model\Interfaces\ProjectInterface;

/**
 * Class IssuePriorityRepository.
 *
 * @package Kreta\Component\Project\Repository
 */
class IssuePriorityRepository extends EntityRepository
{
    /**
     * Finds all the issue priorities of project given.
     *
     * @param \Kreta\Component\Project\Model\Interfaces\ProjectInterface $project  The project
     * @param null|int                                                   $limit    The limit
     * @param null|int                                                   $offset   The offset
     * @param null|string                                                $criteria The filter criteria
     *
     * @return \Kreta\Component\Project\Model\Interfaces\IssuePriorityInterface[]
     */
    public function findByProject(ProjectInterface $project, $limit = null, $offset = null, $criteria = null)
    {
        return $this->findBy(
            ['project' => $project, 'like' => ['name' => $criteria]], ['name' => 'ASC'], $limit, $offset
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getQueryBuilder()
    {
        return parent::getQueryBuilder()
            ->addSelect(['p'])
            ->join('ip.project', 'p');
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'ip';
    }
}

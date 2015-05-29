<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Kreta\Component\Project\Repository;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Kreta\Component\Core\spec\Kreta\Component\Core\Repository\BaseEntityRepository;
use Kreta\Component\Project\Model\Interfaces\ProjectInterface;
use Kreta\Component\User\Model\Interfaces\UserInterface;
use Prophecy\Argument;

/**
 * Class ProjectRepositorySpec.
 *
 * @package spec\Kreta\Component\Project\Repository
 */
class ProjectRepositorySpec extends BaseEntityRepository
{
    function let(EntityManager $manager, ClassMetadata $metadata)
    {
        $this->beConstructedWith($manager, $metadata);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kreta\Component\Project\Repository\ProjectRepository');
    }

    function it_extends_kreta_entity_repository()
    {
        $this->shouldHaveType('Kreta\Component\Core\Repository\EntityRepository');
    }

    function it_finds_by_participant(
        ProjectInterface $project,
        UserInterface $user,
        EntityManager $manager,
        QueryBuilder $queryBuilder,
        Expr $expr,
        Expr\Comparison $comparison,
        AbstractQuery $query
    )
    {
        $queryBuilder = $this->getQueryBuilderSpec($manager, $queryBuilder);
        $this->addCriteriaSpec($queryBuilder, $expr, ['par.user' => $user], $comparison);
        $this->orderBySpec($queryBuilder, ['name' => 'ASC']);
        $queryBuilder->setMaxResults(10)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setFirstResult(1)->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn([$project]);

        $this->findByParticipant($user, ['name' => 'ASC'], 10, 1)->shouldReturn([$project]);
    }

    protected function getQueryBuilderSpec(EntityManager $manager, QueryBuilder $queryBuilder)
    {
        $manager->createQueryBuilder()->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->select('p')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->addSelect(['img', 'i', 'w'])->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->from(Argument::any(), 'p', null)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('p.image', 'img')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('p.issues', 'i')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->join('p.participants', 'par')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->join('p.workflow', 'w')->shouldBeCalled()->willReturn($queryBuilder);

        return $queryBuilder;
    }

    protected function getAlias()
    {
        return 'p';
    }
}

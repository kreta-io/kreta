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

use Kreta\SharedKernel\Domain\Model\Collection;
use Kreta\TaskManager\Domain\Model\Organization\Member;
use Kreta\TaskManager\Domain\Model\Organization\MemberCollection;
use Kreta\TaskManager\Domain\Model\User\UserId;
use PhpSpec\ObjectBehavior;

class MemberCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MemberCollection::class);
        $this->shouldHaveType(Collection::class);
    }

    function it_contains_element(Member $member, UserId $userId)
    {
        $this->add($member);
        $member->userId()->shouldBeCalled()->willReturn($userId);
        $userId->equals($userId)->shouldBeCalled()->willReturn(true);
        $this->contains($member)->shouldReturn(true);
    }

    function it_does_not_contain_element(Member $member)
    {
        $this->contains($member)->shouldReturn(false);
    }
}

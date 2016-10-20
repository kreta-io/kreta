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

declare(strict_types=1);

namespace Kreta\TaskManager\Domain\Model\Organization;

use Kreta\SharedKernel\Domain\Model\Collection;

class MemberCollection extends Collection
{
    protected function type() : string
    {
        return Member::class;
    }

    public function contains($element)
    {
        $members = $this->toArray();
        foreach ($members as $member) {
            if ($element->userId()->equals($member->userId())) {
                return true;
            }
        }

        return false;
    }
}

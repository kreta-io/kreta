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

namespace Kreta\Notifier\Domain\Model\User;

use Kreta\SharedKernel\Domain\Model\AggregateRoot;

class User extends AggregateRoot
{
    private $id;

    public function __construct(UserId $id)
    {
        $this->id = $id;
    }

    public function id() : UserId
    {
        return $this->id;
    }

    public function __toString() : string
    {
        return (string) $this->id->id();
    }
}

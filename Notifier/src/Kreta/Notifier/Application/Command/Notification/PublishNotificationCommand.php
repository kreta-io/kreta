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

namespace Kreta\Notifier\Application\Command\Notification;

use Kreta\SharedKernel\Domain\Model\Identity\Uuid;

class PublishNotificationCommand
{
    private $id;
    private $body;
    private $userId;

    public function __construct(string $body, string $userId, string $id = null)
    {
        $this->id = null === $id ? Uuid::generate() : $id;
        $this->body = $body;
        $this->userId = $userId;
    }

    public function id() : string
    {
        return $this->id;
    }

    public function body() : string
    {
        return $this->body;
    }

    public function userId() : string
    {
        return $this->userId;
    }
}

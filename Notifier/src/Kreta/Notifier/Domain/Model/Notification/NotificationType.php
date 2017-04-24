<?php

declare(strict_types=1);

namespace Kreta\Notifier\Domain\Model\Notification;

class NotificationType
{
    const READ = 'read';
    const UNREAD = 'unread';

    private $type;

    public function __construct(string $type)
    {
        if ($type !== self::READ && $type !== self::UNREAD) {
            throw new NotificationTypeNotAllowedException($type);
        }
        $this->type = $type;
    }

    public static function read()
    {
        return new self(self::READ);
    }

    public static function unread()
    {
        return new self(self::UNREAD);
    }

    public function type() : string
    {
        return $this->type;
    }

    public function __toString() : string
    {
        return (string) $this->type;
    }
}

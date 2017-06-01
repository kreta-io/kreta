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

namespace Kreta\Notifier\Infrastructure\Symfony\DoctrineDataFixtures;

use Kreta\Notifier\Infrastructure\Persistence\Doctrine\DataFixtures\LoadUserData as BaseLoadUserData;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends BaseLoadUserData implements ContainerAwareInterface
{
    public function setContainer(ContainerInterface $container = null)
    {
        $this->commandBus = $container->get('kreta.notifier.command_bus');
        $this->predis = $container->get('snc_redis.default');
    }
}

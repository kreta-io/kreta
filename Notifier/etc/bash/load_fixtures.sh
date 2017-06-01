#!/usr/bin/env bash

# This file is part of the Kreta package.
#
# (c) Beñat Espiña <benatespina@gmail.com>
# (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
#
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.

$(dirname $0)/../bin/symfony-console doctrine:fixtures:load \
    --no-interaction \
    --fixtures=src/Kreta/Notifier/Infrastructure/Symfony/DoctrineDataFixtures

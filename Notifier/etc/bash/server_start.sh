#!/usr/bin/env bash

# This file is part of the Kreta package.
#
# (c) Beñat Espiña <benatespina@gmail.com>
# (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
#
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.

$(dirname $0)/../bin/symfony-console server:start 127.0.0.1:8003 \
    --docroot=src/Kreta/Notifier/Infrastructure/Ui/Http/Symfony/public

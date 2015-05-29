<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Bundle\CoreBundle\Model\Interfaces;

use FOS\OAuthServerBundle\Model\ClientInterface as BaseClientInterface;

/**
 * Interface ClientInterface.
 *
 * @package Kreta\Bundle\CoreBundle\Model\Interfaces
 */
interface ClientInterface extends BaseClientInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();
}

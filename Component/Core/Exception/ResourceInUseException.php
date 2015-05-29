<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Component\Core\Exception;

/**
 * Class ResourceInUseException.
 *
 * @package Kreta\Component\Core\Exception
 */
class ResourceInUseException extends \Exception
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct('The resource is currently in use');
    }
}

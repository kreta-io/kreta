<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Component\Issue\Model\Interfaces;

/**
 * Interface ResolutionInterface.
 *
 * @package Kreta\Component\Issue\Model\Interfaces
 */
interface ResolutionInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Sets description.
     *
     * @param string $description The description
     *
     * @return $this self Object
     */
    public function setDescription($description);
}

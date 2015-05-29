<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Component\Media\Model;

use Kreta\Component\Core\Model\Abstracts\AbstractModel;
use Kreta\Component\Media\Model\Interfaces\MediaInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Media.
 *
 * @package Kreta\Component\Media\Model
 */
class Media extends AbstractModel implements MediaInterface
{
    /**
     * Created at.
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * The media.
     *
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    protected $media;

    /**
     * The name.
     *
     * @var string
     */
    protected $name;

    /**
     * Updated at.
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * {@inheritdoc}
     */
    public function setMedia(UploadedFile $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasMedia()
    {
        return null !== $this->media;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

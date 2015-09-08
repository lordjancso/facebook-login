<?php

namespace AppBundle\Entity\Traits;

use Gedmo\Mapping\Annotation as Gedmo;

trait TimestampableEntity
{
    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="create_datetime", type="datetime", nullable=false)
     */
    protected $createDatetime;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="update_datetime", type="datetime", nullable=false)
     */
    protected $updateDatetime;

    /**
     * Sets createDatetime.
     *
     * @param \DateTime $createDatetime
     * @return $this
     */
    public function setCreatDatetime(\DateTime $createDatetime)
    {
        $this->createDatetime = $createDatetime;

        return $this;
    }

    /**
     * Returns createDatetime.
     *
     * @return \DateTime
     */
    public function getCreatDatetime()
    {
        return $this->createDatetime;
    }

    /**
     * Sets updateDatetime.
     *
     * @param \DateTime $updateDatetime
     * @return $this
     */
    public function setUpdateDatetime(\DateTime $updateDatetime)
    {
        $this->updateDatetime = $updateDatetime;

        return $this;
    }

    /**
     * Returns updateDatetime.
     *
     * @return \DateTime
     */
    public function getUpdateDatetime()
    {
        return $this->updateDatetime;
    }
}

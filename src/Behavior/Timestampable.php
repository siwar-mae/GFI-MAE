<?php

/*
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 *
 * @owner        : Mazars SA - 61 rue Henri Régnault, 92400 Courbevoie
 * @organization : EAZY By Mazars
 * @contact      : christophe.ballihaut@mazars.fr
 *
 * Mazars SA (c) 2016-present
 *
 */

namespace App\Behavior;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;

trait Timestampable
{
    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * Set createdAt.
     *
     * @param DateTime $createdAt
     *
     * @ORM\PrePersist
     *
     * @throws Exception
     */
    public function setCreatedAt()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * Get createdAt.
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param DateTime $updatedAt
     *
     * @ORM\PreUpdate
     *
     * @throws Exception
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * Get updatedAt.
     *
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

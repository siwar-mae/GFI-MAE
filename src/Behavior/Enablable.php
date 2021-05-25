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

/**
 * Trait Enablable.
 */
trait Enablable
{
    /**
     * @var bool
     */
    protected $enabled;

    /**
     * Get enabled.
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}

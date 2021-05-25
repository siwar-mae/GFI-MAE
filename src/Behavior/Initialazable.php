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
 * Trait Initialazable.
 */
trait Initialazable
{
    /**
     * @return $this
     */
    public function initialize(?array $params = []): self
    {
        if (is_array(@$params['filters'])) {
            foreach ($params['filters'] as $field => $value) {
                $this->$field = $value;
            }
        }
        if (is_array(@$params['data'])) {
            foreach ($params['data'] as $field => $value) {
                $this->$field = $value;
            }
        }

        return $this;
    }
}

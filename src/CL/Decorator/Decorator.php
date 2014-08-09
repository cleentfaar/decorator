<?php

/*
 * This file is part of the Decorator library
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Decorator;

class Decorator
{
    /**
     * @var mixed
     */
    protected $originalValue;

    /**
     * {@inheritdoc}
     */
    public function inject($originalValue)
    {
        $this->originalValue = $originalValue;

        return $this;
    }

    /**
     * @return mixed
     */
    protected function getOriginalValue()
    {
        return $this->originalValue;
    }
}

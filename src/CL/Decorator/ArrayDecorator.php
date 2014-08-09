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

class ArrayDecorator extends Decorator implements \ArrayAccess
{
    /**
     * @param mixed $originalValue
     *
     * @throws \InvalidArgumentException
     */
    public function inject($originalValue)
    {
        if (!$this->supports($originalValue)) {
            throw new \InvalidArgumentException('You must provide an array as the original value to use an ArrayDecorator');
        }

        parent::inject($originalValue);
    }
    
    /**
     * @param mixed $originalValue
     *
     * @return bool
     */
    public function supports($originalValue)
    {
        return is_array($originalValue);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->originalValue[] = $value;
        } else {
            $this->originalValue[$offset] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->originalValue[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->originalValue[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return isset($this->originalValue[$offset]) ? $this->originalValue[$offset] : null;
    }
}

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

class MagicObjectDecorator extends ObjectDecorator
{
    /**
     * Delegates calls to the original object, falling back to getter-variants
     *
     * All method calls are delegated in the following order:
     *   1. See if a getter with that name exists in this decorator
     *   2. See if the method exists in the original object
     *   2. See if the getter-method exists in the original object
     *   3. Fail by throwing a RuntimeException
     *
     * @param string $name      The method name
     * @param array  $arguments The arguments used
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public function __call($name, $arguments)
    {
        $getter = 'get' . ucfirst($name);
        if (method_exists($this, $getter)) {
            return call_user_func_array([$this, $getter], $arguments);
        } elseif (method_exists($this->getOriginalValue(), $name)) {
            return call_user_func_array([$this->getOriginalValue(), $name], $arguments);
        } elseif (method_exists($this->getOriginalValue(), $getter)) {
            return call_user_func_array([$this->getOriginalValue(), $getter], $arguments);
        }
        throw new \RuntimeException(sprintf(
            "No method named '%s' for class '%s'",
            $name,
            get_class($this)
        ));
    }
}

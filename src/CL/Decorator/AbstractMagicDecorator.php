<?php

namespace CL\Decorator;

abstract class AbstractMagicDecorator extends AbstractDecorator
{
    /**
     * Delegates calls to the original value if it is an object, and falls back to trying getter-variants
     *
     * All method calls are delegated to in the following order:
     *   1. See if a getter with that name exists in this decorator
     *   2. See if the original value is an object,
     *      a. if method exists in the original object
     *      b. if getter-method exists in the original object
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
        } elseif (is_object($this->getOriginalValue())) {
            if (method_exists($this->getOriginalValue(), $name)) {
                return call_user_func_array([$this->getOriginalValue(), $name], $arguments);
            } elseif (method_exists($this->getOriginalValue(), $getter)) {
                return call_user_func_array([$this->getOriginalValue(), $getter], $arguments);
            }
        }
        throw new \RuntimeException(sprintf(
            "No method named '%s' for class '%s'",
            $name,
            get_class($this)
        ));
    }
}

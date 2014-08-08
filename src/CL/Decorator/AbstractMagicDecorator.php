<?php

namespace CL\Decorator;

abstract class AbstractMagicDecorator extends AbstractDecorator
{
    /**
     * Calls the method on the original value
     *
     * All method calls are delegated to in the following order:
     *   1. See if the method exists in the original object,
     *   2. See if a getter with that name exists in this decorator,
     *   3. See if a getter with that name exists in the original object,
     *   4. Fail by throwing a RuntimeException
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
        if (!is_object($this->getOriginalValue())) {
            throw new \RuntimeException(sprintf(
                'The original value is not an object, and the given method does not exist in this decorator: "%s"',
                $name
            ));
        } elseif (method_exists($this->getOriginalValue(), $name)) {
            return call_user_func_array(array($this->getOriginalValue(), $name), $arguments);
        } elseif (method_exists($this, 'get' . ucfirst($name))) {
            return call_user_func_array(array($this, 'get' . ucfirst($name)), $arguments);
        } elseif (method_exists($this->getOriginalValue(), 'get' . ucfirst($name))) {
            return call_user_func_array(array($this->getOriginalValue(), 'get' . ucfirst($name)), $arguments);
        } else {
            throw new \RuntimeException(sprintf(
                "No method named '%s' for object of type '%s'",
                $name,
                get_class($this->getOriginalValue())
            ));
        }
    }
}

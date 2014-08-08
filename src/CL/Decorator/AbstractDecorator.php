<?php

namespace CL\Decorator;

abstract class AbstractDecorator
{
    /**
     * @var mixed
     */
    protected $originalValue;

    /**
     * @param mixed $originalValue
     */
    public function __construct($originalValue)
    {
        $this->originalValue = $originalValue;
    }

    /**
     * @return mixed
     */
    protected function getOriginalValue()
    {
        return $this->originalValue;
    }
}

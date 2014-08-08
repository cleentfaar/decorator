<?php

namespace CL\Decorator\Factory;

use CL\Decorator\DecoratorInterface;

interface DecoratorFactoryInterface
{
    /**
     * @param mixed $originalValue
     *
     * @return DecoratorInterface
     */
    public function decorate($originalValue);

    /**
     * @param mixed $originalValue
     *
     * @return bool
     */
    public function supports($originalValue);
}

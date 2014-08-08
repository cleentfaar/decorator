<?php

namespace CL\Decorator\Tests\Example\Factory;

use CL\Decorator\Factory\DecoratorFactoryInterface;
use CL\Decorator\Tests\Example\User;
use CL\Decorator\Tests\Example\UserDecorator;

class UserDecoratorFactory implements DecoratorFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function decorate($originalValue)
    {
        return new UserDecorator($originalValue);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($originalValue)
    {
        return $originalValue instanceof User;
    }
}

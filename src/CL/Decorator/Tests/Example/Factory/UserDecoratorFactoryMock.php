<?php

namespace CL\Decorator\Tests\Example\Factory;

use CL\Decorator\Factory\DecoratorFactoryInterface;
use CL\Decorator\Tests\Example\UserDecoratorMock;
use CL\Decorator\Tests\Example\UserMock;

class UserDecoratorFactoryMock implements DecoratorFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function decorate($originalValue)
    {
        return new UserDecoratorMock($originalValue);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($originalValue)
    {
        return $originalValue instanceof UserMock;
    }
}

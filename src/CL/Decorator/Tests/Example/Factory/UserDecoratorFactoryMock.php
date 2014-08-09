<?php

/*
 * This file is part of the Decorator library
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

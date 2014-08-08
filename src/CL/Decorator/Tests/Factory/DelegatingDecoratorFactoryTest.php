<?php

/*
 * This file is part of the Decorator package.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Decorator\Tests\Factory;

use CL\Decorator\Factory\DelegatingDecoratorFactory;

/**
 * @author Cas Leentfaar
 */
class DelegatingDecoratorFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers CL\Decorator\Factory\DelegatingDecoratorFactory::supports
     */
    public function testSupports()
    {
        $subFactory = $this->getMock('CL\Decorator\Factory\DecoratorFactoryInterface');
        $subFactory->expects($this->once())->method('supports')->will($this->returnValue(true));
        $delegatingFactory = new DelegatingDecoratorFactory();
        $delegatingFactory->registerFactory($subFactory);
        $this->assertTrue(
            $delegatingFactory->supports('foo.xml'),
            '->supports() returns true if the value is not supported by any decorator factory'
        );

        $subFactory = $this->getMock('CL\Decorator\Factory\DecoratorFactoryInterface');
        $subFactory->expects($this->once())->method('supports')->will($this->returnValue(false));
        $delegatingFactory = new DelegatingDecoratorFactory();
        $delegatingFactory->registerFactory($subFactory);
        $this->assertFalse(
            $delegatingFactory->supports('foo.foo'),
            '->supports() returns false if the value is not supported by any decorator factory'
        );
    }

    /**
     * @covers CL\Decorator\Factory\DelegatingDecoratorFactory::decorate
     */
    public function testDecorate()
    {
        $subFactory = $this->getMock('CL\Decorator\Factory\DecoratorFactoryInterface');
        $subFactory->expects($this->any())->method('supports')->will($this->returnValue(true));
        $subFactory->expects($this->once())->method('decorate');

        $delegatingFactory = new DelegatingDecoratorFactory();
        $delegatingFactory->registerFactory($subFactory);
        $delegatingFactory->decorate('foo');
    }
}

<?php

/*
 * This file is part of the Decorator package.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Decorator\Tests;

use CL\Decorator\DelegatingDecorator;

/**
 * @author Cas Leentfaar
 */
class DelegatingDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \CL\Decorator\Factory\DelegatingDecorator::supports
     */
    public function testSupports()
    {
        $subFactory = $this->getMock('CL\Decorator\DecoratorInterface');
        $subFactory->expects($this->once())->method('supports')->will($this->returnValue(true));
        $delegatingFactory = new DelegatingDecorator();
        $delegatingFactory->registerDecorator($subFactory);
        $this->assertTrue(
            $delegatingFactory->supports('foo.xml'),
            '->supports() returns true if the value is not supported by any decorator factory'
        );

        $subFactory = $this->getMock('CL\Decorator\DecoratorInterface');
        $subFactory->expects($this->once())->method('supports')->will($this->returnValue(false));
        $delegatingFactory = new DelegatingDecorator();
        $delegatingFactory->registerDecorator($subFactory);
        $this->assertFalse(
            $delegatingFactory->supports('foo.foo'),
            '->supports() returns false if the value is not supported by any decorator factory'
        );
    }

    /**
     * @covers \CL\Decorator\DelegatingDecorator::decorate
     */
    public function testDecorate()
    {
        $subFactory = $this->getMock('CL\Decorator\DecoratorInterface');
        $subFactory->expects($this->any())->method('supports')->will($this->returnValue(true));
        $subFactory->expects($this->once())->method('inject');

        $delegatingDecorator = new DelegatingDecorator();
        $delegatingDecorator->registerDecorator($subFactory);
        $delegatingDecorator->inject('foo');
    }
}

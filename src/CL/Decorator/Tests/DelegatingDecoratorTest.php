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
     * @covers \CL\Decorator\DelegatingDecorator::supports
     */
    public function testSupports()
    {
        $delegateableDecorator = $this->getMock('CL\Decorator\DelegateableDecoratorInterface');
        $delegateableDecorator->expects($this->once())->method('supports')->will($this->returnValue(true));
        $delegatingFactory = new DelegatingDecorator();
        $delegatingFactory->registerDecorator($delegateableDecorator);
        $this->assertTrue(
            $delegatingFactory->supports('foo.xml'),
            '->supports() returns true if the value is not supported by any decorator factory'
        );

        $delegateableDecorator = $this->getMock('CL\Decorator\DelegateableDecoratorInterface');
        $delegateableDecorator->expects($this->once())->method('supports')->will($this->returnValue(false));
        $delegatingFactory = new DelegatingDecorator();
        $delegatingFactory->registerDecorator($delegateableDecorator);
        $this->assertFalse(
            $delegatingFactory->supports('foo.foo'),
            '->supports() returns false if the value is not supported by any decorator factory'
        );
    }

    /**
     * @covers \CL\Decorator\DelegatingDecorator::inject
     */
    public function testInject()
    {
        $delegateableDecorator = $this->getMock('CL\Decorator\DelegateableDecoratorInterface');
        $delegateableDecorator->expects($this->any())->method('supports')->will($this->returnValue(true));
        $delegateableDecorator->expects($this->once())->method('inject');

        $delegatingDecorator = new DelegatingDecorator();
        $delegatingDecorator->registerDecorator($delegateableDecorator);
        $delegatingDecorator->inject('foo');
    }
}

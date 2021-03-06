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

use CL\Decorator\ArrayDecorator;

/**
 * @author Cas Leentfaar
 */
class ArrayDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $array = [
        'foo' => 'bar',
    ];

    /**
     * @var ArrayDecorator
     */
    protected $arrayDecorator;

    protected function setUp()
    {
        $this->arrayDecorator = new ArrayDecorator();
        $this->arrayDecorator->inject($this->array);
    }

    /**
     * @covers CL\Decorator\ArrayDecorator
     */
    public function testDecoratorAccess()
    {
        $this->assertInstanceOf('\ArrayAccess', $this->arrayDecorator);
        $this->assertArrayHasKey('foo', $this->arrayDecorator);
        $this->assertEquals('bar', $this->arrayDecorator['foo']);
    }
}

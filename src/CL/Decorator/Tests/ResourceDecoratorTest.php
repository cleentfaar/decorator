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

use CL\Decorator\ResourceDecorator;

/**
 * @author Cas Leentfaar
 */
class ResourceDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var resource
     */
    protected $resource;

    /**
     * @var ResourceDecorator
     */
    protected $resourceDecorator;

    protected function setUp()
    {
        $this->resource          = fopen('php://memory', 'r');
        $this->resourceDecorator = new ResourceDecorator($this->resource);
    }

    /**
     * @covers CL\Decorator\ResourceDecorator
     */
    public function testGetterMethods()
    {
        $this->assertInternalType('resource', $this->resourceDecorator->getResource());
        $this->assertEquals('stream', $this->resourceDecorator->getType());
        $this->assertRegExp('/^[0-9]+$/', (string) $this->resourceDecorator->getId());
    }
}

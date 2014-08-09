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
        $this->resourceDecorator = new ResourceDecorator();
    }

    /**
     * @covers CL\Decorator\ResourceDecorator
     */
    public function testGetterMethods()
    {
        $this->resourceDecorator->inject(fopen('php://memory', 'r'));
        $this->assertInternalType('resource', $this->resourceDecorator->getResource());
        $this->assertEquals('stream', $this->resourceDecorator->getType());
        $this->assertRegExp('/^[0-9]+$/', (string) $this->resourceDecorator->getId());
    }
}

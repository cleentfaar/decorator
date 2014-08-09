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

use CL\Decorator\Tests\Example\UserDecoratorMock;
use CL\Decorator\Tests\Example\UserMock;

/**
 * @author Cas Leentfaar
 */
class ObjectDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserDecoratorMock
     */
    protected $userDecorator;

    /**
     * @var UserMock
     */
    protected $userMock;

    protected function setUp()
    {
        $this->userMock = new UserMock();
        $this->userMock->setDateOfBirth(new \DateTime('-27 years'));

        $this->userDecorator = new UserDecoratorMock();
    }

    /**
     * @covers CL\Decorator\ObjectDecorator
     */
    public function testDecoratorCall()
    {
        $decorator = $this->userDecorator->inject($this->userMock);
        $this->assertEquals(27, $decorator->getAge());
    }
}

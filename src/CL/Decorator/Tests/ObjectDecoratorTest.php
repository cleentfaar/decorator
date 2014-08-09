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

    protected function setUp()
    {
        $originalValue = new UserMock();
        $originalValue->setDateOfBirth(new \DateTime('-27 years'));

        $this->userDecorator = new UserDecoratorMock($originalValue);
    }

    /**
     * @covers CL\Decorator\AbstractDecorator
     */
    public function testDecoratorCall()
    {
        $this->assertEquals(27, $this->userDecorator->getAge());
    }
}

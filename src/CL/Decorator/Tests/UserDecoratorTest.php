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

use CL\Decorator\Tests\Example\User;
use CL\Decorator\Tests\Example\UserDecorator;

/**
 * @author Cas Leentfaar
 */
class UserDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserDecorator
     */
    protected $userDecorator;

    protected function setUp()
    {
        $originalValue = new User();
        $originalValue->setDateOfBirth(new \DateTime('-27 years'));

        $this->userDecorator = new UserDecorator($originalValue);
    }

    /**
     * @covers CL\Decorator\AbstractDecorator
     */
    public function testDecoratorCall()
    {
        $this->assertEquals(27, $this->userDecorator->getAge());
    }
}

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
use CL\Decorator\Tests\Example\UserMagicDecorator;

/**
 * @author Cas Leentfaar
 */
class UserMagicDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserMagicDecorator
     */
    protected $userDecorator;

    protected function setUp()
    {
        $originalValue = new User();
        $originalValue->setDateOfBirth(new \DateTime('-27 years'));

        $this->userDecorator = new UserMagicDecorator($originalValue);
    }

    /**
     * @covers CL\Decorator\AbstractMagicDecorator::__call
     */
    public function testDecoratorCall()
    {
        $this->assertEquals(27, $this->userDecorator->age());
    }

    /**
     * @covers CL\Decorator\AbstractMagicDecorator::__call
     */
    public function testOriginalCall()
    {
        $this->assertEquals($this->userDecorator->getDateOfBirth(), $this->userDecorator->dateOfBirth());
        $this->assertEquals($this->userDecorator->getDateOfBirth(), $this->userDecorator->getDateOfBirth());
    }
}

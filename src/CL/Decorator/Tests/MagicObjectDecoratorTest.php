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

use CL\Decorator\Tests\Example\UserMock;
use CL\Decorator\Tests\Example\UserMagicMock;

/**
 * @author Cas Leentfaar
 */
class MagicObjectDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserMagicMock
     */
    protected $userDecorator;

    protected function setUp()
    {
        $originalValue = new UserMock();
        $originalValue->setDateOfBirth(new \DateTime('-27 years'));

        $this->userDecorator = new UserMagicMock($originalValue);
    }

    /**
     * @covers \CL\Decorator\MagicObjectDecorator::__call
     */
    public function testDecoratorCall()
    {
        $this->assertEquals(
            27,
            $this->userDecorator->{'age'}(),
            'age should be callable if getAge exists in the magic decorator'
        );
    }

    /**
     * @covers \CL\Decorator\MagicObjectDecorator::__call
     */
    public function testOriginalCall()
    {
        $this->assertEquals(
            $this->userDecorator->{'getDateOfBirth'}(),
            $this->userDecorator->{'dateOfBirth'}(),
            'dateOfBirth should be callable if getDateOfBirth exists'
        );

        $this->assertEquals(
            $this->userDecorator->{'getDateOfBirth'}(),
            $this->userDecorator->{'getDateOfBirth'}(),
            'original method geDateOfBirth should be callable'
        );
    }
}

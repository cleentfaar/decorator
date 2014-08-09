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
use CL\Decorator\Tests\Example\UserMagicDecoratorMock;
use CL\Decorator\Tests\Example\UserMock;

/**
 * @author Cas Leentfaar
 */
class MagicObjectDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserMock
     */
    protected $userMock;

    /**
     * @var UserMagicDecoratorMock
     */
    protected $userDecoratorMock;

    protected function setUp()
    {
        $this->userMock = new UserMock();
        $this->userMock->setDateOfBirth(new \DateTime('-27 years'));

        $this->userDecoratorMock = new UserMagicDecoratorMock();
        $this->userDecoratorMock->inject($this->userMock);
    }

    /**
     * @covers \CL\Decorator\MagicObjectDecorator::__call
     */
    public function testGetters()
    {
        $this->assertEquals(
            27,
            $this->userDecoratorMock->{'age'}(),
            'age should be callable if getAge exists in the magic decorator'
        );
    }

    /**
     * @covers \CL\Decorator\MagicObjectDecorator::__call
     */
    public function testOriginalGettersSetters()
    {
        $this->assertEquals(
            $this->userDecoratorMock->{'getDateOfBirth'}(),
            $this->userMock->getDateOfBirth(),
            'original method geDateOfBirth should be callable'
        );

        $this->assertEquals(
            $this->userDecoratorMock->{'getDateOfBirth'}(),
            $this->userDecoratorMock->{'dateOfBirth'}(),
            'dateOfBirth should be callable if getDateOfBirth exists'
        );

        $this->userDecoratorMock->{'setDateOfBirth'}(new \DateTime('-50 years'));
        $this->assertEquals(50, $this->userDecoratorMock->getAge());
    }
}

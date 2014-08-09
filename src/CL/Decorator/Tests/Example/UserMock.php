<?php

namespace CL\Decorator\Tests\Example;

/**
 * User testing class
 *
 * A real class would obviously have much more methods to represent a user with, but these will suffice to emulate the
 * decoration functionality during tests.
 */
class UserMock
{
    /**
     * @var \DateTime
     */
    protected $dateOfBirth;

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth(\DateTime $dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
}

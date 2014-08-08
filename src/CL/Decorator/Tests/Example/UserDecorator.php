<?php

namespace CL\Decorator\Tests\Example;

use CL\Decorator\AbstractDecorator;

class UserDecorator extends AbstractDecorator
{
    /**
     * Returns the user's age
     *
     * @return int
     */
    public function getAge()
    {
        $dob = $this->getOriginalValue()->getDateOfBirth();

        if ($dob instanceof \DateTime) {
            return $dob->diff(new \DateTime())->format('%y');
        }

        return 0;
    }
}

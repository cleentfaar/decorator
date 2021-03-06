<?php

/*
 * This file is part of the Decorator library
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Decorator\Tests\Example;

use CL\Decorator\ObjectDecorator;

class UserDecoratorMock extends ObjectDecorator
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

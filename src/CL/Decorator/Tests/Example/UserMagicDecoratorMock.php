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

use CL\Decorator\MagicObjectDecorator;

class UserMagicDecoratorMock extends MagicObjectDecorator
{
    /**
     * Returns the user's age
     *
     * @return int
     */
    public function getAge()
    {
        $dob = $this->{'getDateOfBirth'}();

        if ($dob instanceof \DateTime) {
            return $dob->diff(new \DateTime())->format('%y');
        }

        return 0;
    }
}

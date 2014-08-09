<?php

/*
 * This file is part of the Decorator library
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Decorator\Factory;

use CL\Decorator\DecoratorInterface;

interface DecoratorFactoryInterface
{
    /**
     * @param mixed $originalValue
     *
     * @return DecoratorInterface
     */
    public function decorate($originalValue);

    /**
     * @param mixed $originalValue
     *
     * @return bool
     */
    public function supports($originalValue);
}

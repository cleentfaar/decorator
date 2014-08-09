<?php

/*
 * This file is part of the Decorator package.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Decorator;

/**
 * @author Cas Leentfaar
 */
interface DelegateableDecoratorInterface extends DecoratorInterface
{
    /**
     * @param mixed $originalValue
     *
     * @return bool
     */
    public function supports($originalValue);
}

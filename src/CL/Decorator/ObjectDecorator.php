<?php

/*
 * This file is part of the Decorator library
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Decorator;

class ObjectDecorator extends Decorator implements DelegateableDecoratorInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function inject($originalValue)
    {
        if (!$this->supports($originalValue)) {
            throw new \InvalidArgumentException('You must provide an object as the original value to use an ObjectDecorator');
        }

        return parent::inject($originalValue);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($originalValue)
    {
        return is_object($originalValue);
    }
}

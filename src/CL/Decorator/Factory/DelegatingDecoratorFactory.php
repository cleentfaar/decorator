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

class DelegatingDecoratorFactory implements DecoratorFactoryInterface
{
    /**
     * @var DecoratorFactoryInterface[]
     */
    protected $factories = [];

    /**
     * @param DecoratorFactoryInterface $factory
     */
    public function registerFactory(DecoratorFactoryInterface $factory)
    {
        $this->factories[] = $factory;
    }

    /**
     * @param mixed $originalValue
     *
     * @return DecoratorInterface
     *
     * @throws \InvalidArgumentException
     */
    public function decorate($originalValue)
    {
        foreach ($this->factories as $factory) {
            if ($factory->supports($originalValue) === true) {
                return $factory->decorate($originalValue);
            }
        }

        throw new \InvalidArgumentException(sprintf(
            'No factory registered supporting that value: "%s"',
            var_export($originalValue, true)
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function supports($class)
    {
        foreach ($this->factories as $factory) {
            if ($factory->supports($class) === true) {
                return true;
            }
        }

        return false;
    }
}

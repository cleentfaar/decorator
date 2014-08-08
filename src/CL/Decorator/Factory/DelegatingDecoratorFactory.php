<?php

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

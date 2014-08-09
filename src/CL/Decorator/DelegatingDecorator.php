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

class DelegatingDecorator implements DecoratorInterface
{
    /**
     * @var DecoratorInterface[]
     */
    protected $decorators = [];

    /**
     * @param DecoratorInterface $decorator
     */
    public function registerDecorator(DecoratorInterface $decorator)
    {
        $this->decorators[] = $decorator;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException If there is no decorator supporting the given value
     */
    public function inject($originalValue)
    {
        foreach ($this->decorators as $decorator) {
            if ($decorator->supports($originalValue) === true) {
                $decorator->inject($originalValue);
            }
        }

        throw new \InvalidArgumentException(sprintf(
            'No decorator registered supporting the given value: "%s"',
            var_export($originalValue, true)
        ));
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException If there is no decorator supporting the given value
     */
    public function decorate($originalValue)
    {
        foreach ($this->decorators as $decorator) {
            if ($decorator->supports($originalValue) === true) {
                return $decorator->inject($originalValue);
            }
        }

        throw new \InvalidArgumentException(sprintf(
            'No decorator registered supporting the given value: "%s"',
            var_export($originalValue, true)
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function supports($class)
    {
        foreach ($this->decorators as $decorator) {
            if ($decorator->supports($class) === true) {
                return true;
            }
        }

        return false;
    }
}

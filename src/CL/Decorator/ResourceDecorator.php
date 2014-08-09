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

class ResourceDecorator extends Decorator implements DelegateableDecoratorInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function inject($originalValue)
    {
        if (!$this->supports($originalValue)) {
            throw new \InvalidArgumentException('You must provide a resource as the original value to use a ResourceDecorator');
        }

        parent::inject($originalValue);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($originalValue)
    {
        return is_resource($originalValue);
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->getOriginalValue();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return intval($this->getResource());
    }

    /**
     * @return string
     */
    public function getType()
    {
        return get_resource_type($this->getResource());
    }
}

<?php

namespace Wanimo\Mowlkky\CoreBundle\Specification;

use Wanimo\Mowlkky\CoreDomain\Specification;

/**
 * Simple Adaptor to turn a RulerZSpecification into a Mowllky one.
 */
class RulerZAdaptor implements Specification
{
    /**
     * @var \RulerZ\Spec\Specification
     */
    private $base;

    public function __construct(\RulerZ\Spec\Specification $base)
    {
        $this->base = $base;
    }

    /**
     * The rule representing the specification.
     *
     * @return string
     */
    public function getRule()
    {
        return $this->base->getRule();
    }

    /**
     * The parameters used in the specification.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->base->getParameters();
    }
}

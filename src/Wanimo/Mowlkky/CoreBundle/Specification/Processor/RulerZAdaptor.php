<?php

namespace Wanimo\Mowlkky\CoreBundle\Specification\Processor;

use RulerZ\RulerZ;
use Wanimo\Mowlkky\CoreDomain\Specification;

/**
 * Adaptor for the RulerZ library, to work with the CoreBundle
 */
class RulerZAdaptor implements Processor
{
    /**
     * @var RulerZ
     */
    private $rulerZ;

    /**
     * RulerZAdaptor constructor.
     * @param RulerZ $rulerZ
     */
    public function __construct(RulerZ $rulerZ)
    {
        $this->rulerZ = $rulerZ;
    }

    /**
     * @param mixed $target
     * @param Specification $specification
     * @return mixed
     */
    public function applyOnTarget($target, Specification $specification)
    {
        return $this->rulerZ->filterSpec($target, $specification);
    }
}
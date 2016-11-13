<?php

namespace Wanimo\Mowlkky\CoreBundle\Specification\Processor;

use Wanimo\Mowlkky\CoreDomain\Specification;

interface Processor
{
    /**
     * @param mixed $target
     * @param Specification $specification
     * @return mixed
     */
    public function applyOnTarget($target, Specification $specification);
}

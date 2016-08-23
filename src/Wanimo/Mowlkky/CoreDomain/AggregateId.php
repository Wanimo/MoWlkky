<?php

namespace Wanimo\Mowlkky\CoreDomain;

interface AggregateId
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function __toString(): string;
}

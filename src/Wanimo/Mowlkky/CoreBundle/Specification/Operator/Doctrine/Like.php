<?php

namespace Wanimo\Mowlkky\CoreBundle\Specification\Operator\Doctrine;

/**
 * Makes Rulerz LIKE operator work with Doctrine.
 */
class Like
{
    public function __invoke($column, $value)
    {
        return sprintf('%s LIKE %s', $column, $value);
    }
}

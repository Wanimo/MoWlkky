<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament\Specification;

use Wanimo\Mowlkky\CoreDomain\Specification;

/**
 * Specification to get Tournament named like the given expression.
 */
class NamedLike implements Specification
{
    /**
     * @var string
     */
    private $name;

    /**
     * HasNameLike constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * The rule representing the specification.
     *
     * @return string
     */
    public function getRule()
    {
        return 'name.value LIKE :tournament_named_like';
    }

    /**
     * The parameters used in the specification.
     *
     * @return array
     */
    public function getParameters()
    {
        return ['tournament_named_like' => $this->name];
    }
}

<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament;

final class Name
{
    /**
     * @var string
     */
    private $value;

    /**
     * TournamentName constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
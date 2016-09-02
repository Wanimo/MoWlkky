<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament;

use InvalidArgumentException;

final class Status
{
    const STATUS_CREATING = 'creating';
    const STATUS_READY = 'ready';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_ENDED = 'ended';

    /**
     * @var string
     */
    private $value;

    /**
     * Status constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $value = strtolower($value);

        if (!in_array($value, [self::STATUS_CREATING, self::STATUS_READY, self::STATUS_IN_PROGRESS, self::STATUS_ENDED])) {
            throw new InvalidArgumentException(sprintf('%s is not an allowed status for %s creation', self::class));
        }

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
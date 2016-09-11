<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

use InvalidArgumentException;

/**
 * Value object for a user identity.
 */
final class Identity
{
    const VALIDATION_PATTERN = '/^[a-zÀ-ÿ]+([-\' ]|[a-zÀ-ÿ])*$/i';

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * Name constructor.
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $firstName, string $lastName)
    {
        $this->checkValueFormat($firstName, 'firstName');
        $this->checkValueFormat($lastName, 'lastName');

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @param string $value
     * @param string $valueName
     * @throws InvalidArgumentException
     */
    protected function checkValueFormat(string $value, string $valueName)
    {
        if (!preg_match(self::VALIDATION_PATTERN, $value)) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s can only contain letters, dashes or spaces and start with a letter. "%s" is invalid.',
                    $valueName,
                    $value
                )
            );
        }
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s %s', strtoupper($this->lastName), $this->firstName);
    }
}

<?php

namespace Wanimo\Mowlkky\CoreDomain\Validation;

use Symfony\Component\Validator\Constraint as Assert;

/**
 * Constraints container for a command validation.
 */
class ConstraintsCollection
{
    /**
     * @var Assert[]
     */
    private $assertions;

    /**
     * ConstraintsCollection constructor.
     */
    public function __construct()
    {
        $this->assertions = [];
    }

    /**
     * @param $attributeName
     * @param Assert[] $constraints
     * @return ConstraintsCollection
     */
    public function addAssertions($attributeName, array $constraints): ConstraintsCollection
    {
        foreach ($constraints as $constraint) {
            $this->addAssertion($attributeName, $constraint);
        }

        return $this;
    }

    /**
     * @param $attributeName
     * @param Assert $constraint
     * @return ConstraintsCollection
     */
    public function addAssertion($attributeName, Assert $constraint): ConstraintsCollection
    {
        if (!array_key_exists($attributeName, $this->assertions)) {
            $this->assertions[$attributeName] = [];
        }

        $this->assertions[$attributeName][] = $constraint;

        return $this;
    }

    /**
     * @return Assert[]
     */
    public function getAssertions()
    {
        return $this->assertions;
    }

    /**
     * @param string $attributeName
     * @return array|Assert
     */
    public function getAttributeAssertions($attributeName)
    {
        $result = [];

        if (array_key_exists($attributeName, $this->assertions)) {
            $result = $this->assertions[$attributeName];
        }

        return $result;
    }
}

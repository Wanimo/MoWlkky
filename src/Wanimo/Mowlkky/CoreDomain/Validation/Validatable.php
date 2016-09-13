<?php

namespace Wanimo\Mowlkky\CoreDomain\Validation;

/**
 * Interface for commands able to be validated by a validation service.
 */
interface Validatable
{
    /**
     * @return ConstraintsCollection
     */
    public static function getValidationConstraints(): ConstraintsCollection;
}
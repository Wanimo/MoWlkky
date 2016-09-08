<?php

namespace Wanimo\Mowlkky\CoreBundle\Validation;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ConstraintViolationException extends \InvalidArgumentException
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $violationList;

    /**
     * Create a new constraint violation exception from a constraint violation list.
     *
     * @param ConstraintViolationListInterface $violationList
     * @return ConstraintViolationException
     */
    public static function createFromViolationList(ConstraintViolationListInterface $violationList)
    {
        $message = sprintf(
            "Validation failed because of %s :\n",
            (count($violationList) > 1 ? 'these violations' : 'this violation')
        );

        foreach ($violationList as $key => $violation) {
            /** @var ConstraintViolationInterface $violation */
            $message .= sprintf("%s : %s\n", $violation->getPropertyPath(), $violation->getMessage());
        }

        $exception = new self($message);
        $exception->violationList = $violationList;

        return $exception;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolationList()
    {
        return $this->violationList;
    }
}

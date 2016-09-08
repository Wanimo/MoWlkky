<?php

namespace Wanimo\Mowlkky\CoreBundle\Command;

use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Wanimo\Mowlkky\CoreBundle\Validation\ConstraintViolationException;
use Wanimo\Mowlkky\CoreDomain\Command\Command;
use Wanimo\Mowlkky\CoreDomain\Command\CommandBus;
use Wanimo\Mowlkky\CoreDomain\Validation\Validatable;

/**
 * Command bus decorator with a validator
 */
class BusWithValidation implements CommandBus
{
    /**
     * @var Bus
     */
    private $baseBus;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * CommandBusWithValidation constructor.
     * @param CommandBus $baseBus
     * @param ValidatorInterface $validator
     */
    public function __construct(CommandBus $baseBus, ValidatorInterface $validator)
    {
        $this->baseBus = $baseBus;
        $this->validator = $validator;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command)
    {
        if ($command instanceof Validatable) {
            $this->validate($command);
        }

        $this->baseBus->handle($command);
    }

    /**
     * Validate the given command
     *
     * @param Validatable $command
     */
    private function validate(Validatable $command)
    {
        $constraints = $command::getValidationConstraints();
        $context = $this->validator->startContext();

        foreach ($constraints as $propertyName => $propertyConstraints) {
            $context
                ->atPath($propertyName)
                ->validateProperty($command, $propertyName, $propertyConstraints);
        }

        $violations = $context->getViolations();

        if ($violations->count() > 0) {
            throw ConstraintViolationException::createFromViolationList($violations);
        }
    }
}
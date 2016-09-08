<?php

namespace Wanimo\Mowlkky\CoreBundle\Command;

use Exception;
use Wanimo\Mowlkky\CoreDomain\Command\Command;
use Wanimo\Mowlkky\CoreDomain\Command\CommandBus;
use Wanimo\Mowlkky\CoreDomain\UnitOfWork;

/**
 * Command bus decorator with transaction
 */
class TransactionalBus implements CommandBus
{
    /**
     * @var Bus
     */
    private $baseBus;

    /**
     * @var UnitOfWork
     */
    private $uow;

    /**
     * TransactionalBus constructor.
     * @param CommandBus $baseBus
     * @param UnitOfWork $uow
     */
    public function __construct(CommandBus $baseBus, UnitOfWork $uow)
    {
        $this->baseBus = $baseBus;
        $this->uow = $uow;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command)
    {
        $this->uow->beginTransaction();

        try {
            $this->baseBus->handle($command);

            $this
                ->uow
                ->flush()
                ->commit();
        } catch (Exception $e) {
            $this->uow->rollBack();

            throw $e;
        }
    }
}

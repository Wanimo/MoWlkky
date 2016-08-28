<?php

namespace Wanimo\Mowlkky\BackBundle\Command;

use Closure;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question;
use Wanimo\Mowlkky\CoreDomain\User\Email;
use Wanimo\Mowlkky\CoreDomain\User\Identity;

/**
 * Command to create User from the console.
 */
class CreateUserCommand extends Command
{
    /**
     * Command configuration
     */
    protected function configure()
    {
        $this
            ->setName('mowlkky:user:create')
            ->setDescription('Creates a new user.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output
            ->writeln([
                'User creation',
                '-------------',
                ''
            ]);

        $helper = $this->getHelper('question');
        $this->askEmailUntilItsValid($helper, $input, $output);

        return 0;
    }

    /**
     * @param Closure $closure
     * @param OutputInterface $output
     * @return mixed
     */
    protected function askQuestion(Closure $closure, OutputInterface $output)
    {
        $value = null;

        do {
            try {
                $value = $closure();
                $valid = true;
            } catch (InvalidArgumentException $e) {
                $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
                $valid = false;
            }
        } while (!$valid);

        return $value;
    }

}
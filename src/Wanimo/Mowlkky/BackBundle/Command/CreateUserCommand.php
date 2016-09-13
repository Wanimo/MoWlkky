<?php

namespace Wanimo\Mowlkky\BackBundle\Command;

use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Wanimo\Mowlkky\CoreDomain\User\Email;
use Wanimo\Mowlkky\CoreDomain\User\RegisterUserCommand;
use Wanimo\Mowlkky\CoreDomain\User\Role;

/**
 * Command to create User from the console.
 */
class CreateUserCommand extends ContainerAwareCommand
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
        $bus = $this->getContainer()->get('mowlkky.command.bus_transactional');
        $userRepository = $this->getContainer()->get('mowlkky.repository.user');

        $command = new RegisterUserCommand();

        $output
            ->writeln([
                'User creation',
                '-------------',
                ''
            ]);

        // Fill the command object with user's answers
        $helper = $this->getHelper('question');

        $emailQuestion = $this->createQuestion('Email : ', 'email');
        $command->withEmail($helper->ask($input, $output, $emailQuestion));

        $firstNameQuestion = $this->createQuestion('First name : ', 'firstName');
        $command->withFirstName($helper->ask($input, $output, $firstNameQuestion));

        $lastNameQuestion = $this->createQuestion('Last name : ', 'lastName');
        $command->withLastName($helper->ask($input, $output, $lastNameQuestion));

        $passwordQuestion = $this->createQuestion('Password : ', 'password', true);
        $command->withRawPassword($helper->ask($input, $output, $passwordQuestion));

        $roleQuestion = new Question\ChoiceQuestion('Role : ', [Role::ROLE_ADMIN, Role::ROLE_REFEREE], 0);
        $roleQuestion
            ->setErrorMessage('Role %s is invalid.')
            ->setMaxAttempts(2);

        $command->withRole($helper->ask($input, $output, $roleQuestion));

        // Then execute the command
        $bus->handle($command);

        $user = $userRepository->findOneByEmail(new Email($command->getEmail()));

        $output->writeln([
            '',
            '-------------',
            sprintf('<info>User was registered with id %s</info>', $user->getId())
        ]);

        return 0;
    }

    /**
     * @param string $label
     * @param string $propertyName
     * @param bool $isPassword
     * @return Question\Question
     */
    protected function createQuestion(string $label, string $propertyName, $isPassword = false)
    {
        /** @var ValidatorInterface $validator */
        $validator = $this->getContainer()->get('validator');

        $question = new Question\Question(sprintf('<question>%s</question>', $label));
        $question->setValidator(function ($answer) use ($validator, $propertyName) {
            $errors = $validator
                ->validate(
                    $answer,
                    RegisterUserCommand::getValidationConstraints()->getAttributeAssertions($propertyName)
                );

            if (count($errors) > 0) {
                throw new InvalidArgumentException($errors);
            }

            return $answer;
        });

        $question->setMaxAttempts(2);

        if ($isPassword) {
            $question
                ->setHidden(true)
                ->setHiddenFallback(false);
        }

        return $question;
    }

}

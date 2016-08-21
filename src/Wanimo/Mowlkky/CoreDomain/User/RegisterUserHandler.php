<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

/**
 * Handler for the RegisterUserCommand
 */
final class RegisterUserHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * RegisterUserHandler constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterUserCommand $command
     * @return User
     * @throws NotUniqueEmailException
     */
    public function handle(RegisterUserCommand $command)
    {
        if ($this->userRepository->findOneByEmail($command->getEmail())) {
            throw new NotUniqueEmailException($command->getEmail()->getValue());
        }

        $user = User::registerUser($command);

        $this->userRepository->add($user);

        return $user;
    }
}
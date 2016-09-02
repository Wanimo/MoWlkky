<?php

namespace Wanimo\Mowlkky\CoreDomain\User;
use Wanimo\Mowlkky\CoreDomain\User\Password\PasswordEncoder;

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
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * RegisterUserHandler constructor.
     * @param UserRepository $userRepository
     * @param PasswordEncoder $passwordEncoder
     */
    public function __construct(UserRepository $userRepository, PasswordEncoder $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
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

        $user = User::registerUser($command, $this->passwordEncoder);

        $this->userRepository->add($user);

        return $user;
    }
}
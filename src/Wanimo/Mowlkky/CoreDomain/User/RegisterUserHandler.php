<?php

namespace Wanimo\Mowlkky\CoreDomain\User;
use Wanimo\Mowlkky\CoreDomain\User\Password\PasswordEncoder;
use Wanimo\Mowlkky\CoreDomain\User\Password\RawPassword;
use Wanimo\Mowlkky\CoreDomain\UuidGenerator;

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
     * @var UuidGenerator
     */
    private $uuidGenerator;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * RegisterUserHandler constructor.
     * @param UserRepository $userRepository
     * @param UuidGenerator $uuidGenerator
     * @param PasswordEncoder $passwordEncoder
     */
    public function __construct(
        UserRepository $userRepository, UuidGenerator $uuidGenerator, PasswordEncoder $passwordEncoder
    )
    {
        $this->userRepository = $userRepository;
        $this->uuidGenerator = $uuidGenerator;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param RegisterUserCommand $command
     * @return User
     * @throws NotUniqueEmailException
     */
    public function handle(RegisterUserCommand $command)
    {
        $email = new Email($command->getEmail());

        if ($this->userRepository->findOneByEmail($email)) {
            throw new NotUniqueEmailException($command->getEmail());
        }

        $user = User::registerUser(
            new UserId($this->uuidGenerator->generate()),
            $email,
            new Identity($command->getFirstName(), $command->getLastName()),
            (new RawPassword($command->getPassword()))->encode($this->passwordEncoder, uniqid()),
            new Role($command->getRole())
        );

        $this->userRepository->add($user);

        return $user;
    }
}
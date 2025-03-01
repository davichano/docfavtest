<?php

namespace Application\UseCase;

use Application\DTO\RegisterUserRequest;
use Domain\User\Entity\User;
use Domain\User\Event\UserRegisteredEvent;
use Domain\User\Exception\UserAlreadyExistsException;
use Domain\User\Repository\UserRepositoryInterface;
use Domain\User\ValueObject\UserId;
use Psr\EventDispatcher\EventDispatcherInterface;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(UserRepositoryInterface $userRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function execute(RegisterUserRequest $request): User
    {
        $existingUser = $this->userRepository->findByEmail($request->email);
        if ($existingUser) {
            throw new UserAlreadyExistsException($request->email->value());
        }

        $user = new User(
            new UserId(),
            $request->name,
            $request->email,
            $request->password
        );

        $this->userRepository->save($user);

        $event = new UserRegisteredEvent($user);
        $this->eventDispatcher->dispatch($event);

        return $user;
    }
}
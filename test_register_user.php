<?php

use Application\DTO\RegisterUserRequest;
use Application\UseCase\RegisterUserUseCase;
use Infrastructure\Persistence\DoctrineUserRepository;

require_once "vendor/autoload.php";
require_once "config/doctrine.php";
require_once "config/event_dispatcher.php";

$userRepository = new DoctrineUserRepository();
$eventDispatcher = getEventDispatcher();

$useCase = new RegisterUserUseCase($userRepository, $eventDispatcher);

$request = new RegisterUserRequest(
    "David Paredes",
    "david@paredes.com",
    "SecureP@ss123!"
);

try {
    $user = $useCase->execute($request);
    echo "User saved with ID: " . $user->getId()->value();
} catch (Domain\User\Exception\UserAlreadyExistsException $e) {
    echo "Error: " . $e->getMessage();
}
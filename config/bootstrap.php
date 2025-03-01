<?php

use Application\UseCase\RegisterUserUseCase;
use Infrastructure\Persistence\DoctrineUserRepository;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/doctrine.php';
require_once __DIR__ . '/event_dispatcher.php';

function getRegisterUserUseCase(): RegisterUserUseCase
{
    static $registerUserUseCase = null;
    if ($registerUserUseCase) {
        return $registerUserUseCase;
    }

    $userRepository = new DoctrineUserRepository();
    $registerUserUseCase = new RegisterUserUseCase($userRepository, getEventDispatcher());

    return $registerUserUseCase;
}

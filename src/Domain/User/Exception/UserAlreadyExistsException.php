<?php

namespace Domain\User\Exception;

use Exception;

class UserAlreadyExistsException extends Exception
{
    public function __construct(string $email)
    {
        parent::__construct("The user with email '{$email}' already exists.");
    }
}
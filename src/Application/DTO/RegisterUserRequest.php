<?php

namespace Application\DTO;

use Domain\User\ValueObject\Email;
use Domain\User\ValueObject\Name;
use Domain\User\ValueObject\Password;

class RegisterUserRequest
{
    public Name $name;
    public Email $email;
    public Password $password;

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = new Name($name);
        $this->email = new Email($email);
        $this->password = new Password($password);
    }
}
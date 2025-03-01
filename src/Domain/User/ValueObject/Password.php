<?php

namespace Domain\User\ValueObject;

use InvalidArgumentException;

class Password
{
    private string $hash;

    public function __construct(string $plainTextPassword)
    {
        if (
            strlen($plainTextPassword) < 8
            || !preg_match('/[A-Z]/', $plainTextPassword)
            || !preg_match('/[0-9]/', $plainTextPassword)
            || !preg_match('/\W/', $plainTextPassword)
        ) {
            throw new InvalidArgumentException("Password must be at least 8 characters long and include an uppercase letter, a number, and a special character.");
        }
        $this->hash = password_hash($plainTextPassword, PASSWORD_DEFAULT);
    }

    public function verify(string $plainTextPassword): bool
    {
        return password_verify($plainTextPassword, $this->hash);
    }

    public function hash(): string
    {
        return $this->hash;
    }

    public function __toString(): string
    {
        return $this->hash;
    }

}
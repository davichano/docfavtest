<?php

namespace Domain\User\ValueObject;

class UserId
{
    private string $value;

    public function __construct(?string $value = null)
    {
        $this->value = $value ?? uniqid();
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }

}
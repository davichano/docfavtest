<?php

namespace Unit\ValueObject;

use Domain\User\ValueObject\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testValidEmail(): void
    {
        $email = new Email('david@email.com');
        $this->assertEquals('david@email.com', $email->value());
    }

    public function testInvalidEmailThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('invalid-email');
    }
}

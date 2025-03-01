<?php

namespace Unit\ValueObject;

use Domain\User\ValueObject\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testPasswordHashing(): void
    {
        $password = new Password('123P@ssw0rd');
        $this->assertNotEquals('123P@ssw0rd', $password->hash());
        $this->assertTrue(password_verify('123P@ssw0rd', $password->hash()));
    }
}

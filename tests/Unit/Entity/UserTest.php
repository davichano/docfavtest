<?php

namespace Unit\Entity;

use Domain\User\Entity\User;
use Domain\User\ValueObject\Email;
use Domain\User\ValueObject\Name;
use Domain\User\ValueObject\Password;
use Domain\User\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $user = new User(
            new UserId(),
            new Name('David'),
            new Email('david@email.com'),
            new Password('Password123@')
        );

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('David', $user->getName()->value());
        $this->assertEquals('david@email.com', $user->getEmail()->value());
    }
}

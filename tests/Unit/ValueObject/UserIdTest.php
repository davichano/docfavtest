<?php

namespace Unit\ValueObject;

use Domain\User\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function testUserIdIsGenerated(): void
    {
        $userId = new UserId();
        $this->assertNotEmpty($userId->value());
    }
}

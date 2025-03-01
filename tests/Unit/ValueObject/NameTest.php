<?php

namespace Unit\ValueObject;

use Domain\User\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testValidName(): void
    {
        $name = new Name('David');
        $this->assertEquals('David', $name->value());
    }
}

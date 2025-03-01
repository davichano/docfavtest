<?php

namespace Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Domain\User\ValueObject\Password;

class PasswordType extends StringType
{
    const NAME = 'password_type';

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Password ? $value->hash() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): Password
    {
        return new Password($value);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
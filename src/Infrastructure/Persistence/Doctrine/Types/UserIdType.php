<?php

namespace Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Domain\User\ValueObject\UserId;

class UserIdType extends GuidType
{
    const NAME = 'user_id';

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof UserId ? $value->value() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return new UserId($value);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
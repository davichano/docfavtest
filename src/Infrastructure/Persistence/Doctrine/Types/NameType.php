<?php

namespace Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Domain\User\ValueObject\Name;

class NameType extends StringType
{
    const NAME = 'name_type';

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Name ? $value->value() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): Name
    {
        return new Name($value);
    }

    public function getName()
    {
        return self::NAME;
    }
}
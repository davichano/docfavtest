<?php

namespace Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Domain\User\ValueObject\Email;

class EmailType extends StringType
{
    const NAME = 'email_type';

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Email ? $value->value() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): Email
    {
        return new Email($value);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;
use Infrastructure\Persistence\Doctrine\Types\EmailType;
use Infrastructure\Persistence\Doctrine\Types\NameType;
use Infrastructure\Persistence\Doctrine\Types\PasswordType;
use Infrastructure\Persistence\Doctrine\Types\UserIdType;

require_once __DIR__ . '/../vendor/autoload.php';


/**
 * @throws \Doctrine\DBAL\Exception
 */
function getEntityManager(): EntityManager
{
    static $entityManager = null;
    if ($entityManager) {
        return $entityManager;
    }

    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    if (!Type::hasType(UserIdType::NAME)) {
        Type::addType(UserIdType::NAME, UserIdType::class);
    }

    if (!Type::hasType(NameType::NAME)) {
        Type::addType(NameType::NAME, NameType::class);
    }

    if (!Type::hasType(EmailType::NAME)) {
        Type::addType(EmailType::NAME, EmailType::class);
    }

    if (!Type::hasType(PasswordType::NAME)) {
        Type::addType(PasswordType::NAME, PasswordType::class);
    }

    $config = ORMSetup::createAttributeMetadataConfiguration(
        [__DIR__ . '/../src/Domain/User/Entity'],
        true
    );

    // create the connection parameters
    $connectionParams = [
        'dbname' => $_ENV['DB_NAME'] ?? null,
        'user' => $_ENV['DB_USER'] ?? null,
        'password' => $_ENV['DB_PASSWORD'] ?? null,
        'host' => $_ENV['DB_HOST'] ?? null,
        'driver' => $_ENV['DB_DRIVER'] ?? null,
    ];

    if (!$connectionParams['dbname'] || !$connectionParams['user'] || !$connectionParams['host'] || !$connectionParams['driver']) {
        die("Error: Database configuration is missing");
    }

    $connection = DriverManager::getConnection($connectionParams, $config);
    $entityManager = new EntityManager($connection, $config);
    return $entityManager;
}

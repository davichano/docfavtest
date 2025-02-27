<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';


function getEntityManager(): EntityManager
{

    static $entityManager = null;
    if ($entityManager) {
        return $entityManager;
    }
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $config = ORMSetup::createAttributeMetadataConfiguration(
        [__DIR__ . '/../src/Domain/User/Entity'],
        true
    );

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

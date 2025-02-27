<?php
// bootstrap.php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once "vendor/autoload.php";
require_once "config/doctrine.php";

$entityManager = getEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);



<?php

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Domain\User\Entity\User;
use Domain\User\ValueObject\Email;
use Domain\User\ValueObject\Name;
use Domain\User\ValueObject\Password;
use Domain\User\ValueObject\UserId;
use Infrastructure\Persistence\DoctrineUserRepository;

require_once "vendor/autoload.php";
require_once "config/doctrine.php";

$userRepository = new DoctrineUserRepository();

$user = new User(
    new UserId(),
    new Name("John Doe"),
    new Email("johndoe@example.com"),
    new Password("SecureP@ss123!")
);

try {
    $userRepository->save($user);
    echo "User saved with ID: " . $user->getId()->value();
} catch (OptimisticLockException $e) {
    echo "Error de concurrencia al guardar el usuario: " . $e->getMessage();
} catch (ORMException $e) {
    echo "Error en Doctrine ORM: " . $e->getMessage();
}

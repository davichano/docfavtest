<?php

namespace Infrastructure\Persistence;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Domain\User\Entity\User;
use Domain\User\Repository\UserRepositoryInterface;
use Domain\User\ValueObject\UserId;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = getEntityManager();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function delete(UserId $id): void
    {
        $user = $this->findById($id);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function findById(UserId $id): ?User
    {
        return $this->entityManager->find(User::class, $id);
    }
}
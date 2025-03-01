<?php

namespace Unit\UseCase;

use Application\DTO\RegisterUserRequest;
use Application\UseCase\RegisterUserUseCase;
use Doctrine\ORM\EntityManager;
use Domain\User\Entity\User;
use Domain\User\Exception\UserAlreadyExistsException;
use Domain\User\ValueObject\Email;
use Domain\User\ValueObject\Name;
use Domain\User\ValueObject\Password;
use Domain\User\ValueObject\UserId;
use Infrastructure\Persistence\DoctrineUserRepository;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../config/bootstrap.php';
require_once __DIR__ . '/../../../config/doctrine.php';

class RegisterUserUseCaseTest extends TestCase
{
    private RegisterUserUseCase $useCase;
    private DoctrineUserRepository $repository;
    private EntityManager $entityManager;

    /**
     * @throws UserAlreadyExistsException
     */
    public function testUserIsRegistered(): void
    {
        $request = new RegisterUserRequest(
            'David Test',
            'david@test.com',
            'SecureP@ss123!'
        );

//        $this->repository->expects($this->atLeastOnce())->method('save');
        $user = $this->useCase->execute($request);
        $this->assertEquals('David Test', $user->getName());
        $this->assertEquals('david@test.com', $user->getEmail());
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function testCannotRegisterUserWithExistingEmail(): void
    {
        $request = new RegisterUserRequest(
            'David Test Email',
            'david@testemail.com',
            'SecureP@ss123!'
        );

        $expectedAnswer = new User(
            new UserId(),
            new Name('David Test Email'),
            new Email('david@testemail.com'),
            new Password('SecureP@ss123!')
        );

        $this->repository->method('findByEmail')
            ->willReturn($expectedAnswer);

        $this->useCase->execute($request);
        $this->assertSame($expectedAnswer, $this->repository->findByEmail(new Email('david@testemail.com')));
    }

    /**
     * @throws Exception
     * @throws \Doctrine\DBAL\Exception
     */
    protected function setUp(): void
    {
        $this->entityManager = getEntityManager();
        $this->entityManager->beginTransaction();
        $this->repository = $this->createMock(DoctrineUserRepository::class);
        $this->useCase = getRegisterUserUseCase();
    }

    protected function tearDown(): void
    {
        $this->entityManager->rollBack();
    }
}

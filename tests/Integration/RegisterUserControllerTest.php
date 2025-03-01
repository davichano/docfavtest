<?php

namespace Integration;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Presentation\Controller\RegisterUserController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../../config/bootstrap.php';
require_once __DIR__ . '/../../config/doctrine.php';

class RegisterUserControllerTest extends TestCase
{
    private RegisterUserController $controller;
    private EntityManager $entityManager;

    public function testRegisterUserSuccess(): void
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'name' => 'David Paredes Abanto',
            'email' => 'david@paredesabanto.com',
            'password' => 'SecureP@ss123!'
        ]));

        $response = $this->controller->register($request);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('email', $data);
    }

    public function testRegisterUserWithInvalidEmail(): void
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'password' => 'SecureP@ss123!'
        ]));

        $response = $this->controller->register($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(400, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('errors', $data);
        $this->assertArrayHasKey('email', $data['errors']);
    }

    public function testRegisterUserWithWeakPassword(): void
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'weakpass'
        ]));

        $response = $this->controller->register($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(400, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('errors', $data);
        $this->assertArrayHasKey('password', $data['errors']);
    }

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->entityManager = getEntityManager();
        $this->entityManager->beginTransaction();
        $registerUserUseCase = getRegisterUserUseCase();
        $this->controller = new RegisterUserController($registerUserUseCase);
    }

    protected function tearDown(): void
    {
        $this->entityManager->rollback();
    }
}

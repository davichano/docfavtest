<?php

namespace Presentation\Controller;

use Application\DTO\RegisterUserRequest;
use Application\UseCase\RegisterUserUseCase;
use Application\Validator\RegisterUserValidator;
use Domain\User\Exception\UserAlreadyExistsException;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;
    private RegisterUserValidator $validator;

    /**
     * @param RegisterUserUseCase $registerUserUseCase
     */
    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
        $this->validator = new RegisterUserValidator();
    }

    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $validationErrors = $this->validator->validate($data);
        if (!empty($validationErrors)) {
            return new JsonResponse(['errors' => $validationErrors], 400);
        }

        $registerRequest = new RegisterUserRequest(
            $data['name'],
            $data['email'],
            $data['password']
        );

        try {
            $user = $this->registerUserUseCase->execute($registerRequest);
            return new JsonResponse([
                'id' => $user->getId()->value(),
                'name' => $user->getName()->value(),
                'email' => $user->getEmail()->value(),
                'created_at' => $user->getCreatedAt()->format('Y-m-d H:i:s')
            ], 201);
        } catch (UserAlreadyExistsException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 409);
        } catch (Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

}
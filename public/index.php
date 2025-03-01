<?php
require_once __DIR__ . '/../config/bootstrap.php';

use Presentation\Controller\RegisterUserController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$registerUserUseCase = getRegisterUserUseCase();

$userController = new RegisterUserController($registerUserUseCase);

$request = Request::createFromGlobals();
$path = $request->getPathInfo();
$method = $request->getMethod();

$routes = [
    'POST /users' => [$userController, 'register'],
];

$routeKey = "$method $path";

if (isset($routes[$routeKey])) {
    $response = call_user_func($routes[$routeKey], $request);
} else {
    $response = new JsonResponse(['error' => 'Route not found'], 404);
}

$response->send();

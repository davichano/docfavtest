<?php

namespace Application\Validator;

class RegisterUserValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['name']) || !is_string($data['name']) || strlen($data['name']) < 3) {
            $errors['name'] = 'The name must be at least 3 characters.';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email address.';
        }

        if (empty($data['password']) || !$this->isValidPassword($data['password'])) {
            $errors['password'] = 'The password must be at least 8 characters long, include at least 1 uppercase letter, 1 number, and 1 special character.';
        }

        return $errors;
    }

    private function isValidPassword(string $password): bool
    {
        return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
    }
}
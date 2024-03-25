<?php

namespace app\services;

trait PasswordHash
{
    public function passwordHash(string $password): string
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        return $passwordHash;
    }
}
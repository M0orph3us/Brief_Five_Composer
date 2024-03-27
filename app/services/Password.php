<?php

namespace app\services;

trait Password
{
    public function passwordHash(string $password): string
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        return $passwordHash;
    }
}
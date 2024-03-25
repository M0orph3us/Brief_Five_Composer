<?php

namespace app\services;

trait Password
{
    public function passwordHash(string $password): string
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        return $passwordHash;
    }

    public function passwordVerify(string $passwordLogin, string $passwordHash): bool
    {
        return password_verify($passwordLogin, $passwordHash);
    }
}

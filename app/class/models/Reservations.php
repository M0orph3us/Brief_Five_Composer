<?php

namespace app\class\models;

final class Reservations
{
    // params
    private string $uuid, $uuid_users, $reserved_on;
    private int $number_of_persons;
    private bool $baby_chair;
    // constructor
    public function __construct(array $data = null)
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    // function to hydrate
    private function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    // setters & getters

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return int
     */
    public function getNumber_of_persons(): int
    {
        return $this->number_of_persons;
    }

    /**
     * @return bool
     */
    public function getBaby_chair(): bool
    {
        return $this->baby_chair;
    }

    /**
     * @return string
     */
    public function getReserved_on(): string
    {
        return $this->reserved_on;
    }

    /**
     * @return string
     */
    public function getUuid_users(): string
    {
        return $this->uuid_users;
    }
}
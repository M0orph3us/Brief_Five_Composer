<?php

namespace app\class\models;

final class ToAssign
{
    // params
    private string $uuid_teams, $uuid_reservations;

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
    public function getUuid_teams(): string
    {
        return $this->uuid_teams;
    }

    /**
     * @return string
     */
    public function getUuid_reservations(): string
    {
        return $this->uuid_reservations;
    }
}
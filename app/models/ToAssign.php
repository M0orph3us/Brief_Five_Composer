<?php

namespace app\models;

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
     * @param string $uuid_teams
     *
     * @return  self
     */
    public function setUuid_teams(string $uuid_teams): self
    {
        $this->uuid_teams = $uuid_teams;

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid_teams(): string
    {
        return $this->uuid_teams;
    }

    /**
     * @param string $uuid_reservations
     *
     * @return  self
     */
    public function setUuid_reservations(string $uuid_reservations): self
    {
        $this->uuid_reservations = $uuid_reservations;

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid_reservations(): string
    {
        return $this->uuid_reservations;
    }
}
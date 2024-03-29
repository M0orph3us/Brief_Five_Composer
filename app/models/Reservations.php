<?php

namespace app\models;

use DateTime;

final class Reservations
{
    // params
    private string $uuid, $uuid_users, $reserved_on, $uuidFormated;
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

    /**
     * @param  array<string,mixed> $data
     * @return void
     */
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
     * @param string $uuid
     *
     * @return  self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param int $number_of_persons
     *
     * @return  self
     */
    public function setNumber_of_persons(int $number_of_persons): self
    {
        $this->number_of_persons = $number_of_persons;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumber_of_persons(): int
    {
        return $this->number_of_persons;
    }

    /**
     * @param bool $baby_chair
     *
     * @return  self
     */
    public function setBaby_chair(bool $baby_chair): self
    {
        $this->baby_chair = $baby_chair;

        return $this;
    }

    /**
     * @return bool
     */
    public function getBaby_chair(): bool
    {
        return $this->baby_chair;
    }

    /**
     * @param string $reserved_on
     *
     * @return  self
     */
    public function setReserved_on(string $reserved_on): self
    {
        $this->reserved_on = $reserved_on;

        return $this;
    }

    /**
     * @return string
     */
    public function getReserved_on(): string
    {
        $date = new DateTime($this->reserved_on);
        $dateFormat = $date->format('d/m/Y');
        return $dateFormat;
    }

    /**
     * @param string $uuid_users
     *
     * @return  self
     */
    public function setUuid_users(string $uuid_users): self
    {
        $this->uuid_users = $uuid_users;

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid_users(): string
    {
        return $this->uuid_users;
    }

    /**
     * Get the value of uuidFormated
     */
    public function getUuidFormated()
    {
        return $this->uuidFormated;
    }

    /**
     * Set the value of uuidFormated
     *
     * @return  self
     */
    public function setUuidFormated($uuidFormated)
    {
        $this->uuidFormated = $uuidFormated;

        return $this;
    }
}
<?php

namespace app\models;

final class AvailableTables
{
    // params
    private string $uuid, $uuidFormated;
    private int $quantity_tables;

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
     * $return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param int $quantity_tables
     *
     * @return  self
     */
    public function setQuantity_tables(int $quantity_tables): self
    {
        $this->quantity_tables = $quantity_tables;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity_tables(): int
    {
        return $this->quantity_tables;
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
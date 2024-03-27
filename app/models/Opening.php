<?php

namespace app\models;

final class Opening
{
    // params
    private string $uuid, $opening_day, $opening_hour;

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
     * @param string $opening_day
     *
     * @return  self
     */
    public function setOpening_day(string $opening_day): self
    {
        $this->opening_day = $opening_day;

        return $this;
    }

    /**
     * @return string
     */
    public function getOpening_day(): string
    {
        return $this->opening_day;
    }

    /**
     * @param string $opening_hour
     *
     * @return  self
     */
    public function setOpening_hour(string $opening_hour): self
    {
        $this->opening_hour = $opening_hour;

        return $this;
    }

    /**
     * @return string
     */
    public function getOpening_hour(): string
    {
        return $this->opening_hour;
    }
}
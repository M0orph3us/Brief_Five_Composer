<?php

namespace app\models;

final class Opening
{
    // params
    private string $uuid, $opening_day, $morning_opening_hour, $morning_closing_hour, $evening_opening_hour, $evening_closing_hour, $uuidFormated;

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
     * @param  string $uuid
     * @return self
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
     * @return string
     */
    public function getMorning_opening_hour(): string
    {
        return $this->morning_opening_hour;
    }

    /**
     * @param  string $morning_opening_hour
     * @return self
     */
    public function setMorning_opening_hour(string $morning_opening_hour): self
    {
        $this->morning_opening_hour = $morning_opening_hour;

        return $this;
    }

    /**
     * @return string
     */
    public function getMorning_closing_hour(): string
    {
        return $this->morning_closing_hour;
    }

    /**
     * @param  string $morning_closing_hour
     * @return self
     */
    public function setMorning_closing_hour(string $morning_closing_hour): self
    {
        $this->morning_closing_hour = $morning_closing_hour;

        return $this;
    }

    /**
     * @return string
     */
    public function getEvening_opening_hour(): string
    {
        return $this->evening_opening_hour;
    }

    /**
     * @param  string $evening_opening_hour
     * @return self
     */
    public function setEvening_opening_hour(string $evening_opening_hour): self
    {
        $this->evening_opening_hour = $evening_opening_hour;

        return $this;
    }

    /**
     * @return string
     */
    public function getEvening_closing_hour(): string
    {
        return $this->evening_closing_hour;
    }

    /**
     * @param  string $evening_closing_hour
     * @return self
     */
    public function setEvening_closing_hour(string $evening_closing_hour): self
    {
        $this->evening_closing_hour = $evening_closing_hour;

        return $this;
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
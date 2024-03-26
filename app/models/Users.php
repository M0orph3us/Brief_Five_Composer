<?php

namespace app\models;

final class Users
{
    // params
    private string $uuid, $firstname, $lastname, $mail, $password, $role, $created_at;

    // contructor
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
     * @param string $firstname
     *
     * @return  self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param $lastname
     *
     * @return  self
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param $mail
     *
     * @return  self
     */
    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param $password
     *
     * @return  self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param $role
     *
     * @return  self
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param $created_at
     *
     * @return  self
     */
    public function setCreated_at(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     *  @return string
     */
    public function getCreated_at(): string
    {
        return $this->created_at;
    }
}

<?php

namespace App\DTO;

class UsersDTO extends GenericDTO
{
    private $id;
    private $name;
    private $email;
    private $email_verified_at;
    private $password;
    private $remember_token;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getEmailVerifAt()
    {
        return $this->email_verified_at;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setName($val)
    {
        $this->name = $val;
        return $this;
    }
    public function setEmail($val)
    {
        $this->email = $val;
        return $this;
    }
    public function setEmailVerifAt($val)
    {
        $this->email_verified_at = $val;
        return $this;
    }
    public function setPassword($val)
    {
        $this->password = $val;
        return $this;
    }
    public function setRememberToken($val)
    {
        $this->remember_token = $val;
        return $this;
    }
}

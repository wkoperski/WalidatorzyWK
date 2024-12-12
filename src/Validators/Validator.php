<?php

namespace Validators;

use PDO;

class Validator extends \Validator\Validator
{
    public function __construct(
        private readonly int $id=0,
        private readonly string       $name,
        private readonly string       $email,
        private readonly string       $status
    )    {}
    public function __toString(): string
    {
        return $this->id .' '.$this->name.' '.$this->email.' '.$this->status;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
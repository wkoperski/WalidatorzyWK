<?php

namespace Validators;
use PDO;


class Validator
{
    private $validator;
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
class getValidator
{
    static function getValidatorByName(PDO $PDO, string $name): Validator
    {
        $stmt = $PDO->prepare("Select id,nazwa,email,aktywny FROM walidatorzy WHERE nazwa =:name ");
        $stmt->execute(array(
            'name' => $name,
        ));
        $validator = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($name);
        return new Validator($validator->id, $validator['nazwa'], $validator['email'], $validator['aktywny']);
    }

    static function getValidatorById(PDO $PDO,int $id): Validator
    {
        $stmt = $PDO->prepare("Select id,nazwa,email,aktywny FROM walidatorzy WHERE id =:id ");
        $stmt->execute(array(
            'id' => $id,
        ));
        $validator = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        return new Validator($validator['id'], $validator['nazwa'], $validator['email'], $validator['aktywny']);
    }

}
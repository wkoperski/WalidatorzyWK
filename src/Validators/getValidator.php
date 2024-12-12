<?php

namespace Validators;
use PDO;
use Validators\Validator;


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
        return new Validator($validator['id'], $validator['nazwa'], $validator['email'], $validator['aktywny']);
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
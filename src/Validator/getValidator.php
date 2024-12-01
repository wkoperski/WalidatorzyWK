<?php
namespace Validator;
use PDO;

class getValidator
{
    static function getValidatorAll(PDO $PDO,bool $status = true):array
    {
        $stmt = $PDO->prepare("Select * from walidatorzy WHERE aktywny=:status ORDER BY nazwa");
        $stmt->execute(array(
            'status' => $status,
        ));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    static function getValidatorAllforHtmlOptions(PDO $PDO,bool $status = true):array
    {
        $stmt = $PDO->prepare("Select id,nazwa from walidatorzy WHERE aktywny=:status ORDER BY nazwa");
        $stmt->execute(array(
            'status' => $status,
        ));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    static function getValidatorByName(PDO $PDO, string $name):array
    {

        $stmt = $PDO->prepare("Select id,nazwa,email,aktywny FROM walidatorzy WHERE nazwa =:name ");
        $stmt->execute(array(
            'name' => $name,
        ));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
<?php

namespace Validators;

use PDO;


class getValidators
{
    static function byActive(PDO $PDO, string $without_validator):array
    {

        $stmt = $PDO->prepare("Select id,nazwa FROM walidatorzy WHERE aktywny = 1 AND nazwa <> :name ORDER BY nazwa");
        $stmt->execute(array(
            "name" => $without_validator
        ));


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
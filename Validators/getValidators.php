<?php

namespace Validators;

use PDO;
use Validators\Validator;
class getValidators
{

    static function getValidators(PDO $db):array
    {

        $stmt = $db->prepare("SELECT * FROM Walidatorzy ORDER BY Nazwa" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}
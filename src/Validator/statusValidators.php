<?php
namespace Validator;
use PDO;

class statusValidators
{


    static function disbaledValidator(PDO $PDO, Validator $validator):void
    {

        $stmt = $PDO->prepare("UPDATE walidatorzy SET aktywny = 0  WHERE id=:id");
        $stmt->execute(array(
            'id'    => $validator->getId()
        ));
    }

    static function enabledValidator(PDO $PDO, Validator $validator):void
    {

        $stmt = $PDO->prepare("UPDATE walidatorzy SET aktywny = 1  WHERE id=:id");
        $stmt->execute(array(
            'id'    => $validator->getId()
        ));
    }
}
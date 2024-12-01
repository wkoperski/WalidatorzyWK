<?php

namespace Verification\Formal;

use Validator\Validator;
use Verification\Interface\iGet;

class get implements iGet
{
    static function byName(\PDO $PDO, Validator $validator,VerificationStatus $status = null):array
    {
        $query = '';
        $param = '';
        if($status == null)
        {
            $query = 'Select * FROM weryfikacja_formalna WHERE walidator=:walidator';
            $param = array(":walidator" => $validator->getName());
        }

        if($status == VerificationStatus::IN_ACCEPTANCE)
        {
            $query = "Select * FROM weryfikacja_formalna WHERE walidator=:walidator AND status='W AKCEPTACJI'";
            $param = array(":walidator" => $validator->getName());
        }

        $stmt = $PDO->prepare($query);
        $stmt->execute(
            $param
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
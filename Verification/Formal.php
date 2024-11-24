<?php

namespace FormalVerification;

use Validator\Validator;

enum VerificationStatus: string
{
    case ALL = '*';
    case ACCEPT = "AKCEPTACJA";
    case REJECTED = "ODRZUCONA";
    case IN_ACCEPTANCE = "W AKCEPTACJI";

}
class Verification
{

}

class getFormalVerification
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
<?php

namespace TransactionVerification;

use Validator\Validator;
use FormalVerification\VerificationStatus;

class Transaction
{

}

interface iMethodGetVerification
{
    static function byValidatorName(\PDO $PDO, Validator $validator,VerificationStatus $status = null):array;
}
class getTransactionVerification implements iMethodGetVerification
{


    static function byValidatorName(\PDO $PDO, Validator $validator,VerificationStatus $status = null): array
    {
        $query = '';
        $param = '';
        if($status == null)
        {
            $query = "SELECT weryfikacja_transakcyjna.guid, weryfikacja_formalna.nazwa, weryfikacja_formalna.nip,weryfikacja_transakcyjna.zglaszajacy, weryfikacja_transakcyjna.wynik_weryfikacji 
FROM weryfikacja_transakcyjna INNER JOIN weryfikacja_formalna ON weryfikacja_transakcyjna.formalna = weryfikacja_formalna.id 
WHERE weryfikacja_transakcyjna.walidator=:walidator";
            $param = array(":walidator" => $validator->getName());
        }

        if($status = 'W AKCEPTACJI')
        {
            $query = "SELECT weryfikacja_transakcyjna.guid, weryfikacja_formalna.nazwa, weryfikacja_formalna.nip,weryfikacja_transakcyjna.zglaszajacy, weryfikacja_transakcyjna.wynik_weryfikacji 
FROM weryfikacja_transakcyjna INNER JOIN weryfikacja_formalna ON weryfikacja_transakcyjna.formalna = weryfikacja_formalna.id 
WHERE weryfikacja_transakcyjna.walidator=:walidator AND weryfikacja_transakcyjna.status='W AKCEPTACJI'";
            $param = array(
                "walidator" => $validator->getName()
            );
        }

        $stmt = $PDO->prepare($query);
        $stmt->execute(
            $param
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
class changeTransactionVeryfication
{
    static function changeValidator(\PDO $PDO,string $guid, Validator $validator)
    {
        $stmt = $PDO->prepare("UPDATE weryfikacja_transakcyjna SET walidator = :name  WHERE guid=:guid");
        $stmt->execute(array(
            'guid'    => $guid,
            'name'    => $validator->getName()
        ));
    }
}
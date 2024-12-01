<?php
namespace Validator;

use Validator\Validator, PDO;

class checkValidator
{
    static  function IsActiveValidationsFormal(PDO $PDO,Validator $validator):int
    {
        $stmt = $PDO->prepare("Select * FROM weryfikacja_formalna WHERE walidator=:walidator AND status='W AKCEPTACJI'");
        $stmt->execute(
            array(
                'walidator' =>$validator->getName()
            )
        );
        return $stmt->rowCount();
    }

    static  function IsActiveValidationsTransaction(PDO $PDO,Validator $validator):int
    {
        $stmt = $PDO->prepare("Select * FROM weryfikacja_transakcyjna WHERE walidator=:walidator AND status='W AKCEPTACJI'");
        $stmt->execute(
            array(
                'walidator' =>$validator->getName()
            )
        );
        return $stmt->rowCount();
    }

}
<?php

namespace Validator;

use PDO;

class checkValidator
{
    static  function IsActiveValidationsFormal(PDO $PDO,Validator $validator):int
    {
        $stmt = $PDO->prepare("Select * FROM weryfikacja_formalna WHERE id=:walidator AND status='W AKCEPTACJI'");
        $stmt->execute(
            array(
                'walidator' =>$validator->getId()
            )
        );
        return $stmt->rowCount();
    }

}
class ValidatorStatisticsFormalVerification
{    static function getStatisticsFormalVerification(PDO $PDO):array
    {
        $stmt = $PDO->prepare("Select distinct(walidator),status, count(status) as 'LICZBA' from weryfikacja_formalna group by walidator, status ORDER BY walidator");
        $stmt->execute();
        $StatisticsFormalVerification = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $validators_unique = array_unique(array_column($StatisticsFormalVerification, 'walidator'));

        $output = array();
        foreach($validators_unique as $walidator)
        {

            $akceptacja =  array_filter($StatisticsFormalVerification,function ($element) USE($walidator){ if($element['status'] == 'AKCEPTACJA'&& $element['walidator'] == $walidator) {return 1;} });
            $w_akceptacji = array_filter($StatisticsFormalVerification,function ($element) USE($walidator){ if($element['status'] == 'W AKCEPTACJI' && $element['walidator'] == $walidator) {return 1;} });
            $odrzucona = array_filter($StatisticsFormalVerification,function ($element) USE($walidator){ if($element['status'] == 'ODRZUCONA' && $element['walidator'] == $walidator) {return 1;} });

            $output[] = array(
                'walidator' =>  $walidator,
                'akceptacja'    => array_column($akceptacja, 'LICZBA')[0] ?? 0,
                'w_akceptacji'  => array_column($w_akceptacji, 'LICZBA')[0] ?? 0,
                'odrzucona'  => array_column($odrzucona, 'LICZBA')[0] ?? 0,

            );


        }

        return $output;
    }

    static function getStatisticsTransactionVerification(PDO $PDO):array
    {
        $stmt = $PDO->prepare("Select distinct(walidator),status, count(status) as 'LICZBA' from weryfikacja_transakcyjna group by walidator, status ORDER BY walidator");
        $stmt->execute();
        $StatisticsFormalVerification = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $validators_unique = array_unique(array_column($StatisticsFormalVerification, 'walidator'));

        $output = array();
        foreach($validators_unique as $walidator)
        {

            $akceptacja =  array_filter($StatisticsFormalVerification,function ($element) USE($walidator){ if($element['status'] == 'AKCEPTACJA'&& $element['walidator'] == $walidator) {return 1;} });
            $w_akceptacji = array_filter($StatisticsFormalVerification,function ($element) USE($walidator){ if($element['status'] == 'W AKCEPTACJI' && $element['walidator'] == $walidator) {return 1;} });
            $odrzucona = array_filter($StatisticsFormalVerification,function ($element) USE($walidator){ if($element['status'] == 'ODRZUCONA' && $element['walidator'] == $walidator) {return 1;} });

            $output[] = array(
                'walidator' =>  $walidator,
                'akceptacja'    => array_column($akceptacja, 'LICZBA')[0] ?? 0,
                'w_akceptacji'  => array_column($w_akceptacji, 'LICZBA')[0] ?? 0,
                'odrzucona'  => array_column($odrzucona, 'LICZBA')[0] ?? 0,

            );


        }

        return $output;
    }
}
class Validator
{
    private int $id;
    private string $name;
    private string $email;
    private string $status;

    /**
     * @param string $name
     * @param string $email
     */
    public function __construct(int $id, string $name, string $email, bool $status)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->status = $status;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @throws \Exception
     */
    static function getValidatorByName(PDO $PDO, string $name):Validator
    {   
        $stmt = $PDO->prepare("Select * FROM walidatorzy WHERE nazwa=:name");
        $stmt->execute(
            array(
                'name' => $name,
            )
        );
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result)
        {
            throw new \Exception("Brak walidatora o takim imieniu i nazwisku");
        }


        return new Validator($result['id'],$result['nazwa'], $result['email'], $result['aktywny']);
    }

    static function getValidatorByID(PDO $PDO, int $id):Validator
    {


        $stmt = $PDO->prepare("Select * FROM walidatorzy WHERE id=:id");
        $stmt->execute(
            array(
                'id' => $id,
            )
        );

        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
        {
            $validator = new Validator($row['id'],$row['nazwa'], $row['email'], $row['email']);
        }

        return $validator;
    }
}

class ShowValidatorVeryfication
{
    static function showFormalValidations(PDO $PDO, Validator $validator, string $status):array
    {
        $stmt = $PDO->prepare("Select * from weryfikacja_formalna WHERE walidator=:walidator AND status=:status");
        $stmt->execute(
            array(
                'walidator'=>$validator->getName(),
                'status'    =>$status
            ))
        ;

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class getVerificationFormal
{
    static function getVerificationFormalVerification(PDO $PDO, Validator $validator):array
    {
        $stmt = $PDO->prepare("Select * from weryfikacja_formalna WHERE nazwa=:name");
        $stmt->execute(array(
            'name' => $validator->getName(),
        ));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class getValidator
{
    static function getValidatorByName(PDO $PDO, string $name):array
    {

    }
    static function getValidatorByID(PDO $PDO, int $id):array
    {

    }

    static function getValidatorByEmail(PDO $PDO, string $email):array
    {

    }

    static function getValidatorByStatus(PDO $PDO, int $status):array
    {
        
    }
}
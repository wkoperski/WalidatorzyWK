<?php

namespace Validator;

use PDO;

class ValidatorStatisticsFormalVerification
{


    static function getStatisticsFormalVerification(PDO $PDO):array
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
}
class Validator
{
    private string $name;
    private string $surname;
    private string $email;

    /**
     * @param string $name
     * @param string $surname
     * @param string $email
     */
    public function __construct(string $name, string $surname, string $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
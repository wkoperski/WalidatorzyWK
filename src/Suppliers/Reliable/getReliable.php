<?php

namespace Suppliers\Reliable;


use PDO;

class getReliable
{

    public function __construct(private readonly PDO $PDO) { }

    public function getReliableAll():array
    {
        $stmt = $this->PDO->prepare("select * from lista_wiarygodnych ORDER BY nazwa");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getReliableActive():array
    {
        $stmt = $this->PDO->prepare("select lista_wiarygodnych.guid, lista_wiarygodnych.nazwa, lista_wiarygodnych.data_dodania, lista_wiarygodnych.nip,weryfikacja_formalna.data_waznosci, weryfikacja_formalna.data_waznosci FROM lista_wiarygodnych LEFT JOIN weryfikacja_formalna ON lista_wiarygodnych.guid=weryfikacja_formalna.guid WHERE weryfikacja_formalna.data_waznosci >= CURRENT_DATE order by lista_wiarygodnych.nazwa");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
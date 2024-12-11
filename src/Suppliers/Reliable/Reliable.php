<?php

namespace Suppliers\Reliable;

include "vendor/autoload.php";

use DateInterval;
use DateTime;
use PDO;
use GuzzleHttp\Client;

class Reliable
{

}

class getReliableActive
{
    private array $reliable;
    public function __construct(private readonly PDO $PDO)
    {
    }

    public function getReliable(): static
    {
        $stmt = $this->PDO->prepare("select * from zgloszeni_do_wiarygodnych WHERE nip not in (SELECT NIP from zgloszeni_wiarygodni)");
        $stmt->execute();

        $this->reliable = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this;
    }

    public function getReliableFull(): array
    {
        $stmt = $this->PDO->prepare("select * from zgloszeni_wiarygodni JOIN weryfikacja_formalna ON zgloszeni_wiarygodni.guid_wf= weryfikacja_formalna.guid WHERE zgloszeni_wiarygodni.accept = 0 and zgloszeni_wiarygodni.rejection =0   ORDER BY weryfikacja_formalna.nazwa");
        $stmt->execute();


        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNip():array
    {
        return array_column($this->reliable, 'nip');
    }

    public function getGuid():array
    {
        return array_column($this->reliable, 'guid');
    }

    public function getAll():array
    {
        return $this->reliable;
    }

    public function addReliable():void
    {
        $stmt = $this->PDO->prepare("INSERT INTO zgloszeni_wiarygodni (nip, guid_wf, first_invoice, last_invoice, re_verification,checkBeoneCooperation, monthBeoneCooperation) VALUES (?,?,?,?,?,?,?)");
        foreach ($this->reliable as $row) {
            $stmt->execute(
                array(
                    $row['nip'],
                    $row['guid'],
                    (property_exists($row['Beone2'],'firstInvoice')) ? $row['Beone2']->firstInvoice : null,
                    (property_exists($row['Beone2'],'lastInvoice')) ? $row['Beone2']->lastInvoice : null,
                    $row['Beone'],
                    ($row['checkBeoneCooperation']) ? 1 : 0,
                    ($row['monthBeoneCooperation']) ?:0
                )
            );
        }

    }
    
    public function addNipToReliable(string $nip):void
    {
        if(strlen($nip) == 10)
        {
            $stmt = $this->PDO->prepare("SELECT * FROM weryfikacja_formalna where guid = (Select zgloszeni_wiarygodni.guid_wf from zgloszeni_wiarygodni where NIP=?)");
            $stmt->execute(array($nip));
            $data =  $stmt->fetch();
            $stmt = $this->PDO->prepare("INSERT INTO lista_wiarygodnych (nip, guid, nazwa,data_dodania) VALUES (?,?,?,?)");
            $stmt->execute(
                array(
                    $data['nip'],
                    $data['guid'],
                    $data['nazwa'],
                    date('Y-m-d H:i'),
                )
            );
            $this->PDO->prepare("DELETE FROM zgloszeni_wiarygodni where nip=?")->execute(array($data['nip']));
        }


    }

    public function getAcceptReliable():array
    {
        $stmt = $this->PDO->prepare("select weryfikacja_formalna.nazwa, weryfikacja_formalna.nip, weryfikacja_formalna.ocena_wiarygodnosci from zgloszeni_wiarygodni JOIN weryfikacja_formalna ON weryfikacja_formalna.guid = zgloszeni_wiarygodni.guid_wf WHERE accept = 1");
        $stmt->execute();


        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptReliable(string $guid_wf):void
    {
        $stmt = $this->PDO->prepare("UPDATE zgloszeni_wiarygodni SET accept=1 WHERE guid_wf=:guid_wf");

            $stmt->execute(
                array(
                    'guid_wf'   => $guid_wf,
                )
            );
    }

    public function rejectionReliable(string $guid_wf):void
    {
        $stmt = $this->PDO->prepare("UPDATE zgloszeni_wiarygodni SET rejection=1 WHERE guid_wf=:guid_wf");

        $stmt->execute(
            array(
                'guid_wf'   => $guid_wf,
            )
        );
    }
    
    public function checkReVerification():static
    {
        $result = array();
        foreach ($this->reliable as $reliable) {
            $stmt = $this->PDO->prepare("select * from lista_wiarygodnych where nip = :nip AND nip in (select nip from zgloszeni_do_wiarygodnych)");
            $stmt->execute(
                array(
                    'nip' => $reliable['nip']
                )
            );

            if ($stmt->rowCount() > 0) {
                $reliable['Beone'] =  '1';
                $result[] = $reliable;
            }

            if ($stmt->rowCount() == 0) {
                $reliable['Beone'] =  '0';
                $result[] = $reliable;
            }
            $this->reliable = $result;

        }
        return $this;
    }

    private function checkTimeCooperation($firstInvoice):bool
    {

        $firstInvoiceDate = DateTime::createFromFormat('m-d-Y', str_replace(".", "-", $firstInvoice));
        $currentDate = new DateTime();
        $date_test = $firstInvoiceDate->format('Y-m-d');
        $data2 = new DateTime($date_test);
        if($currentDate->diff($data2)->y >= 2){
            return true;
        } else {
            return false;
        }
    }
    private function getMonthCooperation($firstInvoice):int
    {
        $date1=new DateTime(date("Y-m-d"));
        $date2 = new DateTime(date("Y-m-d", strtotime(str_replace('.', '/', $firstInvoice) ) ));

        $data_uzyskania_weryfikacji = $date2->add(DateInterval::createFromDateString('2 year'));
        if($data_uzyskania_weryfikacji->diff($date1)->format("%m") == 0)
        {
            return $data_uzyskania_weryfikacji->diff($date1)->format("%d");
        } else {
            return $data_uzyskania_weryfikacji->diff($date1)->format("%m") * 30 + $data_uzyskania_weryfikacji->diff($date1)->format("%d");
        }
    }
    public function checkBeOne():static
    {
        $result = array();

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://dms.wielton.com.pl/alfresco/s/pl/beone/wielton/invoice/',
            // You can set any number of default request options.
            'timeout'  => 20.0,
            'verify' => false

        ]);
            $tmp_table = array_slice($this->reliable, 0, 200);

        foreach ($tmp_table as $reliable) {


            $response = $client->request('GET', 'invoiceDateFetcher?nip='.$reliable['nip'],['auth' => ['api_beone', 'VvkcrYy0OROZKLZ3wSGb']]);
            $reliable['Beone2'] = json_decode($response->getBody()->getContents());

            if(!property_exists($reliable['Beone2'], 'firstInvoice'))
            {
                $response = $client->request('GET', 'invoiceDateFetcher?nip=PL'.$reliable['nip'],['auth' => ['api_beone', 'VvkcrYy0OROZKLZ3wSGb']]);
                $reliable['Beone2'] = json_decode($response->getBody()->getContents());
            }

            if(property_exists($reliable['Beone2'], 'firstInvoice'))
            {
                $reliable['checkBeoneCooperation'] = $this->checkTimeCooperation($reliable['Beone2']->firstInvoice);
                $reliable['monthBeoneCooperation'] = $this->getMonthCooperation($reliable['Beone2']->firstInvoice);
            } else {
                $reliable['checkBeoneCooperation'] = 0;
                $reliable['monthBeoneCooperation'] = 0;
            }

            /**
             *PORÓWNANIE DWÓCH LAT
             */


            $result[] = $reliable;
        }
        $this->reliable = $result;
        return $this;

    }
}
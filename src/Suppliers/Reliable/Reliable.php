<?php

namespace Suppliers\Reliable;

include "vendor/autoload.php";
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
        $stmt = $this->PDO->prepare("select * from zgloszeni_do_wiarygodnych");
        $stmt->execute();

        $this->reliable = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this;
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

    public function checkBeOne():array
    {
        $result = array();

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://dms.wielton.com.pl/alfresco/s/pl/beone/wielton/invoice/',
            // You can set any number of default request options.
            'timeout'  => 55.0,
            'verify' => false

        ]);
            $tmp_table = array_slice($this->reliable, 0, 10);
        foreach ($tmp_table as $reliable) {
            $response = $client->request('GET', 'invoiceDateFetcher?nip='.$reliable['nip'],['auth' => ['api_beone', 'VvkcrYy0OROZKLZ3wSGb']]);
            $reliable['Beone2'] = json_decode($response->getBody()->getContents());

            $result[] = $reliable;
        }

        return $result;

    }
}
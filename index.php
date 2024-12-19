<?php

use FormalVerification\deleteFormalVeryfication;
use FormalVerification\VerificationStatus;
use Smarty\Smarty;
use Suppliers\Reliable\getReliable;

use Suppliers\Reliable\getReliableActive;
use Validator\addValidator;
use Validator\checkValidator;
use Validator\getValidator;
use Validator\statusValidators;
use Validator\Validator;
use Validator\ValidatorStatisticsFormalVerification;
use Validators\getValidators;
use Verification\Formal\getFormalVerification;

session_start();
include "vendor/autoload.php";
require_once(__DIR__.'/Validator.php');
require_once(__DIR__.'/Verification/Formal.php');
require_once(__DIR__.'/Verification/Transaction.php');
require_once(__DIR__.'/src/Suppliers/Reliable/Reliable.php');
require_once(__DIR__.'/src/Suppliers/Reliable/getReliable.php');
require_once (__DIR__.'/src/Notifications/Email.php');
require_once (__DIR__.'/src/Verification/Formal/getFormalVerification.php');
require_once (__DIR__.'/src/Validators/Validator.php');
require_once (__DIR__.'/src/Validators/getValidator.php');
require_once (__DIR__.'/src/Validators/getValidators.php');


if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'adminwk.wielton.com.pl') {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
} else {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

//Wyłączenie konieczności logowania ze stacji dev
if (isset($_SERVER['COMPUTERNAME']) && $_SERVER['COMPUTERNAME'] == 'WL850') {
    $_SESSION['access_token'] = 'local';
}

function my_custom_autoloader( $class_name ):void
{
    $file = __DIR__.$class_name.'.php';

    if ( file_exists($file) ) {
        require_once $file;
    }

}
spl_autoload_register( 'my_custom_autoloader' );


$smart = new Smarty();

//Wczytywanie pliku konfiguracyjnego w zależności od uruchomienia
if(isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'adminwk.wielton.com.pl') {
    $env = parse_ini_file('env');
} else {
    $env = parse_ini_file('env-dev');
}


$guzzle = new GuzzleHttp\Client();
$tenantId = $env['TENANT_ID'];
$clientId = $env['CLIENT_ID'];
$clientSecret = $env['CLIENT_SECRET'];
$url = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/authorize';

if(isset($_GET['code']))
{

    $postParameter = array(
        'client_id' => $clientId,
        'grant_type' => 'authorization_code',
        'code'  =>  $_GET['code'],
        'redirect_uri'=>'https://adminwk.wielton.com.pl/index.php',
        'client_secret'=>$clientSecret
    );

    $curlHandle = curl_init('https://login.microsoftonline.com/'.$tenantId.'/oauth2/v2.0/token');
    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postParameter);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

    $curlResponse = curl_exec($curlHandle);
    /*echo json_decode($curlResponse);*/

    $json = json_decode($curlResponse);
    if (isset($json->access_token))
    {
        setcookie('access_token', $json->access_token, time() + (3599 * 30), "/"); // 86400 = 1 day
        $_SESSION['access_token'] = $json->access_token;
        var_dump($_SESSION['access_token']);
    }
    header('Location: index.php');
    exit();


}


if (isset($_SESSION['access_token']))
{




   try {
       $db = new PDO("mysql:host=". $env['HOST'] .";dbname=". $env['DB_NAME'] .";port=". $env['DB_PORT'], $env['DB_USER'],$env['DB_PASSWORD']);

   } catch (Exception $e)
   {
        echo $e->getMessage();
        exit();
   }

   /** WALIDATORZY STATYSTYKI */
    if(isset($_GET['walidatorzy_statystyki']))
    {
        $smart->assign('show_walidatorzy_nav',1);
        $smart->assign('show_walidatorzy_statystyki',1);
        $smart->assign('StatisticsFormal', ValidatorStatisticsFormalVerification::getStatisticsFormalVerification($db));
        $smart->assign('StatisticsTransaction', ValidatorStatisticsFormalVerification::getStatisticsTransactionVerification($db));
        try {
            $smart->display('Validators\stats.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
            exit();
        }
        exit();
    }
    /** END WALIDATORZY STATYSTYKI */

    /** WALIDATORZY LISTA */
    if(isset($_GET['walidatorzy_lista']))
    {
        $stmt = $db->prepare("SELECT * FROM Walidatorzy ORDER BY Nazwa" );
        $stmt->execute();
        $smart->assign('walidatorzy', $stmt->fetchAll(PDO::FETCH_ASSOC));
        $smart->assign('show_walidatorzy_nav',1);
        $smart->assign('show_walidatorzy_lista',1);
        try {
            $smart->display('Validators\state.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
            exit();
        }
        exit();
    }
    /** END WALIDATORZY LISTA */


    /** WERYFIKACJA FORMALNA */
    if(isset($_GET['weryfikacja_formalna'])) {

        $smart->assign('formal_data', getFormalVerification::getFormalVerificationByGUID($db,$_GET['guid']));
        try {
            $smart->display('Verification/formal.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
        }
        exit();
    }

    /** WIARYGODNI STATYSTYKI */
    if(isset($_GET['wiarygodni_statystyki'])) {
        $smart->assign('show_wiarygodni_nav',1);
        $smart->assign('show_wiarygodni_statystyki',1);
        try {
            $smart->display('Suppliers/Reliable/stats.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
        }

        exit();
    }
    /** END WIARYGODNI STATYSTYKI */

    //** WIARYGODNI USN */
    if(isset($_GET['wiarygodni_usun']))
    {
        try {
            $getReliable = new getReliable($db);
            $smart->assign('wiarygodni_lista',$getReliable->getReliableActive());
            $smart->assign('show_wiarygodni_nav',1);
            $smart->assign('show_wiarygodni_usun',1);
            $smart->display('Suppliers/Reliable/delete.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();

        } finally {
            exit();
        }
    }

   /** WIARYGODNI DODAJ */
    if(isset($_GET['wiarygodni_dodaj']))
    {
        $Reliable = new getReliableActive($db);
        if(isset($_POST['zatwierdzeni_wiarygodni']))
        {
           $Reliable->addNipToReliable(explode(PHP_EOL,$_POST['nip_lista']));
        }

        $smart->assign('show_wiarygodni_nav',1);
        $smart->assign('show_wiarygodni_dodaj',1);
        $smart->assign('wiarygodni_lista',$Reliable->getAcceptReliable());
        try {
            $smart->display('Suppliers/Reliable/add.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
            exit();
        }
        unset($Reliable);
        exit();
    }
    /** WIARYGODNI LISTA */
    if(isset($_GET['wiarygodni_lista']))
    {
        $Reliable = new getReliableActive($db);
        if(isset($_POST['regenerate_list']))
        {
            $Reliable->getReliable()->checkReVerification();
            $Reliable->checkBeOne();
            $Reliable->addReliable();
           /*
            echo '<pre>';
            var_dump($Reliable->getAll());
            echo '</pre>';*/
        }
        
        if (isset($_POST['csv']) && !isset($_POST['regenerate_list']))
        {
            function array2csv(array $array): bool|string|null
            {
                if (count($array) == 0) {
                    return null;
                }
                ob_start();
                $df = fopen("php://output", 'w');
                fputcsv($df, array_keys(reset($array)));
                foreach ($array as $row) {
                    fputcsv($df, $row);
                }
                fclose($df);
                return ob_get_clean();
            }
            function download_send_headers($filename): void
            {
                // disable caching
                $now = gmdate("D, d M Y H:i:s");
                header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
                header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
                header("Last-Modified: $now GMT");

                // force download
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");

                // disposition / encoding on response body
                header('Content-type: text/csv; charset=UTF-8');
                header("Content-Disposition: attachment;filename=$filename");
                header("Content-Transfer-Encoding: binary");
            }

            download_send_headers("data_export_" . date("Y-m-d") . ".csv");
            echo array2csv($Reliable->getReliableFull());
            die();
        }

        if(isset($_POST['delete']))
        {
            $Reliable->rejectionReliable($_POST['delete']);
            $smart->assign('komunikat',$_POST['delete']);
            $email = new Notifications\Email();

            //FIXME: wysyłania powiadomień na poprawny adres email.

        }

        if(isset($_POST['add']))
        {
            $Reliable->acceptReliable($_POST['add']);

        }

       
        $smart->assign('wiarygodni_lista',$Reliable->getReliableFull());
        $smart->assign('show_wiarygodni_nav',1);
        $smart->assign('show_wiarygodni_lista',1);
        try {
            $smart->display('Suppliers/Reliable/list.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
            exit();
        }
        unset($Reliable);
        exit();
    }


    /** DODAJ WALIDATORA **/

    if(isset($_GET['dodaj_walidatora']))
    {
        if(isset($_POST['name']) && isset($_POST['email']))
        {

            if(count(getValidator::getValidatorByName($db,$_POST['name'])) == 0 && count(getValidator::getValidatorByEmail($db,$_POST['email'])) == 0)
            {

                $smart->assign('komunikat','Nowy Walidator: <strong>'.$_POST['name'].'</strong> został dodany');

                $new_walidator = new addValidator($db,$_POST['name'],$_POST['email']);

            } else {
                $smart->assign('alert_type','danger');
                $smart->assign('komunikat','Istnieje już taki walidator o nazwie: '.$_POST['name'].' lub adresie email: '.$_POST['email']);
            }

        }
        $smart->assign('show_walidatorzy_nav',1);
        $smart->assign('show_walidatorzy_add',1);
        try {
            $smart->display('Validators/add.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
            exit();
        }
        exit();
    }


    /** ZMIANA WALIDATORA **/
    if (isset($_POST['change_verification_formal'])  && isset($_POST['new_validator_verification_formal']))
    {
       FormalVerification\changeFormalVeryfication::changeValidator($db,$_POST['change_verification_formal'], Validators\getValidator::getValidatorById($db,$_POST['new_validator_verification_formal']));
        $smart->assign('komunikat', "Dla weryfikacji <strong>".$_POST['change_verification_formal']."</strong> został zmieniony walidator na ".Validators\getValidator::getValidatorById($db,$_POST['new_validator_verification_formal'])->getName());
        $new_walidator = Validators\getValidator::getValidatorById($db,$_POST['new_validator_verification_formal']);
        $email = new Notifications\Email();
        $email->sendEmail($new_walidator->getEmail(),'Nowa weryfikacja transakcyjna',"Została przydzielona nowa weryfikacja formalna. Zaloguj się na stronie <a href='https://wk.wielton.com.pl'>https://wk.wielton.com.pl</a>'");
        $smart->assign('return',true);

        try {
            $smart->display('Validators/delete.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
            exit();
        }
        exit();
    }

    if (isset($_POST['change_verification_transaction'])  && isset($_POST['new_validator_verification_transaction']))
    {
        TransactionVerification\changeTransactionVeryfication::changeValidator($db,$_POST['change_verification_transaction'], Validators\Validator::getValidatorById($db,$_POST['new_validator_verification_transaction']));
        $smart->assign('komunikat', "Dla weryfikacji <strong>".$_POST['change_verification_transaction']."</strong> został zmieniony walidator na ".Validators\Validator::getValidatorByID($db,$_POST['new_validator_verification_transaction'])->getName());
        $smart->assign('return',true);
        $new_walidator = Validators\getValidator::getValidatorById($db,$_POST['new_validator_verification_transaction']);
        $email = new Notifications\Email();
        $email->sendEmail($new_walidator->getEmail(),'Nowa weryfikacja transakcyjna',"Została przydzielona nowa weryfikacja transakcyjna. Zaloguj się na stronie <a href='https://wk.wielton.com.pl'>https://wk.wielton.com.pl</a>");
        try {
            $smart->display('Validators/delete.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
            exit();
        }
        exit();
    }


    /* AKTYWACJA WALIDATORA */
    if(isset($_POST['validator_enabled']))
    {

        statusValidators::enabledValidator($db, Validator::getValidatorByName($db,$_POST['validator_enabled']));
        $smart->assign('komunikat','Walidator został <strong>włączony</strong>');
        $smart->assign('return',true);
        try {
            $smart->display('Validators/delete.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
            exit();
        }
        exit();
    }
    /* KONIEC AKTYWACJA WALIDATORA */

    /*USUWANIE WALIDATORÓW*/
    if(isset($_POST['validator_delete']))
    {
        $validator_delete = Validator::getValidatorByName($db, $_POST['validator_delete']);

        if(checkValidator::IsActiveValidationsFormal($db, Validator::getValidatorByName($db, $_POST['validator_delete'])) ==0 && checkValidator::IsActiveValidationsTransaction($db, Validator::getValidatorByName($db, $_POST['validator_delete'])) ==0)
        {
            $smart->assign('komunikat','Walidator został wyłączony');
            statusValidators::disbaledValidator($db,$validator_delete);
            $smart->assign('return',true);
        }

        if(isset($_POST['delete_verification_formal']))
        {
            deleteFormalVeryfication::delete($db,$_POST['delete_verification_formal']);
            $smart->assign('komunikat', "Została usunięta weryfikacja transakcyjna o id: ".$_POST['delete_verification_formal']);

        }




        try {
            if (checkValidator::IsActiveValidationsFormal($db, Validator::getValidatorByName($db, $_POST['validator_delete'])) > 0) {
                try {
                    $result = FormalVerification\getFormalVerification::byName($db, Validator::getValidatorByName($db, $_POST['validator_delete']), VerificationStatus::IN_ACCEPTANCE);
                    $smart->assign('formalVerificationList', $result);
                } catch (Exception $e) {

                }




            }
            if (checkValidator::IsActiveValidationsTransaction($db, Validator::getValidatorByName($db, $_POST['validator_delete'])) > 0) {
                try {
                    $result = TransactionVerification\getTransactionVerification::byValidatorName($db, Validator::getValidatorByName($db, $_POST['validator_delete']), VerificationStatus::IN_ACCEPTANCE);
                    $smart->assign('transactionVerificationList', $result);
                } catch (Exception $e) {

                }



            }

        } catch (Exception $e) {

        }
        $val= getValidators::byActive($db,$_POST['validator_delete']);
        $opt = array();
        $opt+= array(0 =>'Wybierz walidatora');
        foreach($val as $row)
            {
                $opt+= array(
                    $row['id']  => $row['nazwa']
                );
            }


        $smart->assign('deleteValidatorName',$_POST['validator_delete']);
        $smart->assign('listValidators',$opt);
        try {
            $smart->display('Validators/delete.tpl');
        } catch (\Smarty\Exception|Exception $e) {
            echo $e->getMessage();
            exit();
        }
        exit();
    }


    try {
        $smart->display('dashboard.tpl');
    } catch (\Smarty\Exception|Exception $e) {
        echo $e->getMessage();
        exit();
    }


} else {
    try {
        $smart->display('login.tpl');
    } catch (\Smarty\Exception|Exception $e) {
        echo $e->getMessage();
        exit();
    }

}



if (isset($_GET['action']) && $_GET['action'] == 'login'){
    $params = array (
        'client_id' =>$clientId,
        'redirect_uri' =>'https://adminwk.wielton.com.pl/index.php',
        'response_type' =>'id_token',
        'response_mode' =>'form_post',
        'scope' =>'https://graph.microsoft.com/User.Read',
        'state' =>$_SESSION['state']);

    header ('Location: '.$url.'?'.http_build_query ($params));
    exit();
}





if (isset($_POST['access_token'])) {
    $_SESSION['t'] = $_POST['access_token'];
    $t = $_SESSION['t'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $t,
        'Content-type: application/json'
    ));
    curl_setopt($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $rez = json_decode(curl_exec($ch), true);
    try {
        $smart->display('index.tpl');
    } catch (\Smarty\Exception|Exception $e) {
        echo $e->getMessage();
        exit();
    }

    if (isset($rez['error'])) {
        var_dump($rez);
        die();
    } else {
        $_SESSION['msatg'] = 1;
        $_SESSION['uname'] = $rez["displayName"];
        $_SESSION['id'] = $rez["id"];
    }

    curl_close($ch);
    header('Location: https://abc.xyz.com/sso/welcome.php');
    exit();
}

if (isset($_GET['logout'])) {
    unset($_SESSION['msatg']);
    header('Location: https://abc.xyz.com/sso/');
    exit();
}


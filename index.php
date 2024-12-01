<?php
session_start();
include "vendor/autoload.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Verification\Formal\VerificationStatus;
use Verification\Transaction\getTransactionVerification;


if (isset($_SERVER['COMPUTERNAME']) && ($_SERVER['COMPUTERNAME'] == 'WL850' || $_SERVER['COMPUTERNAME'] == 'DESKTOP-8ON889J')) {
    $_SESSION['access_token'] = 'local';
}

function my_custom_autoloader( $class_name ):void
{
    $file = __DIR__.$class_name.'.php';
    $parts = explode('\\', $class_name);
    $file2 = $filename = __DIR__.'\\src' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';


    if ( file_exists($file) ) {
        require_once $file;
    }
    if ( file_exists($file2)) {
        var_dump($file2);
        require_once $file2;
    }
}
spl_autoload_register( 'my_custom_autoloader' );


$smart = new \Smarty\Smarty();


$guzzle = new GuzzleHttp\Client();
$tenantId = "62d8e948-4039-40ed-8aaa-260464b28114";
$clientId = "287bf80e-a546-4f3d-a9d5-65a01b6e5588";
$clientSecret = "RA48Q~5Dwjv6CbuAs8Pywl-E0Gkq.aLAdCARwaAI";
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

    $curlHandle = curl_init('https://login.microsoftonline.com/62d8e948-4039-40ed-8aaa-260464b28114/oauth2/v2.0/token');
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

    $env = parse_ini_file('env-dev');


    $db = new PDO("mysql:host=". $env['HOST'] .";dbname=". $env['DB_NAME'] .";port=". $env['PORT'], $env['USER'],$env['PASSWORD']);
    $stmt = $db->prepare("SELECT * FROM Walidatorzy ORDER BY Nazwa" );
    $stmt->execute();
    $smart->assign('walidatorzy', $stmt->fetchAll(PDO::FETCH_ASSOC));
    $smart->assign('StatisticsFormal',\Validator\ValidatorStatisticsFormalVerification::getStatisticsFormalVerification($db));
    $smart->assign('StatisticsTransaction',\Validator\ValidatorStatisticsFormalVerification::getStatisticsTransactionVerification($db));

echo '<pre>';
var_dump($_POST);
echo '</pre>';

    /** ZMIANA WALIDATORA **/
    if (isset($_POST['change_verification_formal'])  && isset($_POST['new_validator_verification_formal']))
    {
        FormalVerification\changeFormalVeryfication::changeValidator($db,$_POST['change_verification_formal'], Validator\Validator::getValidatorByID($db,$_POST['new_validator_verification_formal']));
        $smart->assign('komunikat', "Dla weryfikacji <strong>".$_POST['change_verification_formal']."</strong> został zmieniony walidator na ".Validator\Validator::getValidatorByID($db,$_POST['new_validator_verification_formal'])->getName());
        //$smart->assign('return',true);
        $smart->display('Validators/delete.tpl');
        exit();
    }

    if (isset($_POST['change_verification_transaction'])  && isset($_POST['new_validator_verification_transaction']))
    {
        Verification\Transaction\changeTransactionVeryfication::changeValidator($db,$_POST['change_verification_transaction'], Validator\Validator::getValidatorByID($db,$_POST['new_validator_verification_transaction']));
        $smart->assign('komunikat', "Dla weryfikacji <strong>".$_POST['change_verification_transaction']."</strong> został zmieniony walidator na ".Validator\Validator::getValidatorByID($db,$_POST['new_validator_verification_transaction'])->getName());
       /* $smart->assign('return',true);*/
        $smart->display('Validators/delete.tpl');
        exit();
    }


    /* AKTYWACJA WALIDATORA */
    if(isset($_POST['validator_enabled']))
    {
        try {
            Controller\Validators\enabled::enabled($smart, $db, $_POST['validator_enabled']);
        } catch (\Smarty\Exception $e) {

        }

    }
    /* KONIEC AKTYWACJA WALIDATORA */

    /*USUWANIE WALIDATORÓW*/
    if(isset($_POST['validator_delete']))
    {
        $validator_delete = \Validator\Validator::getValidatorByName($db, $_POST['validator_delete']);

        if(\Validator\checkValidator::IsActiveValidationsFormal($db, \Validator\Validator::getValidatorByName($db, $_POST['validator_delete'])) ==0 && \Validator\checkValidator::IsActiveValidationsTransaction($db, \Validator\Validator::getValidatorByName($db, $_POST['validator_delete'])) ==0)
        {
            $smart->assign('komunikat','Walidator został wyłączony');
            \Validator\statusValidators::disbaledValidator($db,$validator_delete);
            $smart->assign('return',true);
        }

        if(isset($_POST['delete_verification_formal']))
        {
            \FormalVerification\deleteFormalVeryfication::delete($db,$_POST['delete_verification_formal']);
            $smart->assign('komunikat', "Została usunięta weryfikacja transakcyjna o id: ".$_POST['delete_verification_formal']);

        }




        try {
            if (\Validator\checkValidator::IsActiveValidationsFormal($db, \Validator\Validator::getValidatorByName($db, $_POST['validator_delete'])) > 0) {
                try {
                    $result = FormalVerification\getFormalVerification::byName($db, \Validator\Validator::getValidatorByName($db, $_POST['validator_delete']), \FormalVerification\VerificationStatus::IN_ACCEPTANCE);
                    $smart->assign('formalVerificationList', $result);
                } catch (Exception $e) {

                }




            }
            if (\Validator\checkValidator::IsActiveValidationsTransaction($db, \Validator\Validator::getValidatorByName($db, $_POST['validator_delete'])) > 0) {
                try {
                    $result = getTransactionVerification::byValidatorName($db, \Validator\Validator::getValidatorByName($db, $_POST['validator_delete']),VerificationStatus::IN_ACCEPTANCE);
                    $smart->assign('transactionVerificationList', $result);
                } catch (Exception $e) {

                }



            }

        } catch (Exception $e) {

        }
        $val=\Validator\getValidator::getValidatorAll($db);
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
        $smart->display('Validators/delete.tpl');
        exit();
    }


    

    $smart->display('index.tpl');


} else {
    $smart->display('login.tpl');

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
    $smart->display('index.tpl');

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

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['msatg']);
    header('Location: https://abc.xyz.com/sso/');
    exit();
}


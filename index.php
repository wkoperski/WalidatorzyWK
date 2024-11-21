<?php
session_start();
include "vendor/autoload.php";
require_once(__DIR__.'/Validator.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

CONST PORT_WEB_SERVICE = '60449';
function my_custom_autoloader( $class_name ):void
{
    $file = __DIR__.$class_name.'.php';

    if ( file_exists($file) ) {
        require_once $file;
    }
}
spl_autoload_register( 'my_custom_autoloader' );



$val = new Validator\Validator("Wojciech","Koperski","kopsow@gmail.com",true);
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
        'redirect_uri'=>'http://localhost:'.PORT_WEB_SERVICE.'/WalidatorzyWK/index.php',
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
/*$token = json_decode($guzzle->post($url, [
    'form_params' => [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'scope' => 'https://graph.microsoft.com/.default',
        'grant_type' => 'client_credentials',
    ],
])->getBody()->getContents());
$accessToken = $token->access_token;*/

if (isset($_SESSION['access_token']))
{

    $env = parse_ini_file('env');


    $db = new PDO("mysql:host=". $env['HOST'] .";dbname=". $env['DB_NAME'] .";port=". $env['PORT'], $env['USER'],$env['PASSWORD']);
    $stmt = $db->prepare("SELECT * FROM Walidatorzy ORDER BY Nazwa" );
    $stmt->execute();
    $smart->assign('walidatorzy', $stmt->fetchAll(PDO::FETCH_ASSOC));
$smart->assign('StatisticsFormal',\Validator\ValidatorStatisticsFormalVerification::getStatisticsFormalVerification($db));

    $smart->display('index.tpl');


} else {
    $smart->assign('port',PORT_WEB_SERVICE);
    $smart->display('login.tpl');
    //echo "<a href='https://login.microsoftonline.com/62d8e948-4039-40ed-8aaa-260464b28114/oauth2/v2.0/authorize?client_id=287bf80e-a546-4f3d-a9d5-65a01b6e5588&response_type=code&redirect_uri=http://localhost:63352//WalidatorzyWK/index.php&response_mode=query&scope=offline_access%20user.read'>Zaloguj</a>";
}



if (isset($_GET['action']) && $_GET['action'] == 'login'){
    $params = array (
        'client_id' =>$clientId,
        'redirect_uri' =>'http://localhost:'.PORT_WEB_SERVICE.'/WalidatorzyWK/index.php',
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


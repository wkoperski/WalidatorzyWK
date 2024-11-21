<?php
$env = parse_ini_file('env');
$db = new PDO("mysql:host=". $env['HOST'] .";dbname=". $env['DB_NAME'] .";port=". $env['PORT'], $env['USER'],$env['PASSWORD']);
$stmt = $db->prepare("Select distinct(walidator),status, count(status) as 'LICZBA' from weryfikacja_formalna group by walidator, status ORDER BY walidator");
$stmt->execute();
$walidacje = $stmt->fetchAll(PDO::FETCH_ASSOC);


/*echo '<pre>';
print_r($result);

echo '</pre>';

echo '<hr>';

echo '<pre>';


echo '</pre>';*/

function filtr($element) {
    if($element['walidator'] == 'Aneta Piekarek')
    {
        return 1;
    }
}
$zmienna = 'AKCEPTACJA';
//print_r(array_filter($result,function ($element) USE($zmienna){ if($element['status'] == $zmienna) {return 1;} }));
$walidatorzy_unique = array_unique(array_column($walidacje, 'walidator'));

$output = array();
foreach($walidatorzy_unique as $walidator)
{

    $akceptacja =  array_filter($walidacje,function ($element) USE($walidator){ if($element['status'] == 'AKCEPTACJA'&& $element['walidator'] == $walidator) {return 1;} });
    $w_akceptacji = array_filter($walidacje,function ($element) USE($walidator){ if($element['status'] == 'W AKCEPTACJI' && $element['walidator'] == $walidator) {return 1;} });
    $odrzucona = array_filter($walidacje,function ($element) USE($walidator){ if($element['status'] == 'ODRZUCONA' && $element['walidator'] == $walidator) {return 1;} });

    $output[] = array(
        'walidator' =>  $walidator,
        'akceptacja'    => array_column($akceptacja, 'LICZBA')[0] ?? 0,
        'w_akceptacji'  => array_column($w_akceptacji, 'LICZBA')[0] ?? 0,
        'odrzucona'  => array_column($odrzucona, 'LICZBA')[0] ?? 0,

    );


}

echo '<pre>';
print_r($output);
echo '</pre>';
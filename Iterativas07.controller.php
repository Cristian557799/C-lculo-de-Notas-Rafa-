<?php
declare(strict_types=1);

$data = array();

if(empty($_GET['carton']))
{
    $carton = array();
    do{
        $num = rand(1,100);
        if(!in_array($num, $carton)){
            $carton[] = $num;
        }
    }while(count($carton) < 24);
    sort($carton);
    $bolasSalieron[] = rand(1,100);
}
else{
    $carton = $_GET['carton'];

    $bolasSalieron = $_GET['bolasSalieron'];

    $bombo = array_diff(range(1,100), $_GET['bolasSalieron']);

    $bolasSalieron[] = $bombo[array_rand($bombo)];

    $data['win'] = empty(array_diff($carton, $bolasSalieron));
}

$url = [
    'carton' => $carton,
    'bolasSalieron' => $bolasSalieron
];

$data['url_txt'] = http_build_query($url);

$data['bolasSalieron'] = $bolasSalieron;
$data['carton'] = $carton;

function checkErrors(array $data) : array
{
    $errors = array();
    if(empty($data['numero'])){
        $errors['numero'] = 'Inserte el número máximo sobre el que realizar el cálculo';
    }
    elseif(!filter_var($data['numero'], FILTER_VALIDATE_INT)){
        $errors['numero'] = 'Inserte un número entero válido';
    }
    else if((int)$data['numero'] < 2){
    $errors['numero'] = 'El número insertado debe ser mayor o igual a 2.';
    }
    return $errors;
}


include 'views/templates/header.php';
include 'views/templates/iterativas07.view.php';
include 'views/templates/footer.php';
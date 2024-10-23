<?php
declare(strict_types=1);

$data = array();

if(!empty($_POST)){
    $data['errors'] = checkForm($_POST);
    $data['numero'] = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($data['errors'])){
        $ejecuciones = 0;
        $numeros = range(2, (int)$data['numero']);
        $multiplos = [];
        for($i = 2; $i ** 2 <= (int)$data['numero']; $i++){
            if(!in_array($i, $multiplos)) {
                for($j = $i; $j * $i < (int)$data['numero']; $j++){
                    $multiplos[] = $i * $j;
                    $ejecuciones ++;
                }
            }
        }
        $data['ejecuciones'] = $ejecuciones;
        $data['resultado'] = array_diff($numeros, $multiplos);
    }
}

function checkErrors(array $data) : array
{
    $errors = array();
    if(empty($data['numero'])){
        $errors['numero'] = 'Inserte el número máximo sobre el que realizar el cálculo';
    }
    elseif(!filter_var($data['numero'], FILTER_VALIDATE_INT)){
        $errors['numero'] = 'Inserte un número entero válido';
    }
    return $errors;
}

include 'views/templates/header.php';
include 'views/templates/iterativas06.view.php';
include 'views/templates/footer.php';

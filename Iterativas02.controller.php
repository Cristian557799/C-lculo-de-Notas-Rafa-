<?php
declare(strict_types=1);

$data = [];

if(!empty($_POST)){
    //Comprobar
    $errors = checkForm($_POST);
    $data['input_numeros'] = filter_var($_POST['numeros'], FILTER_SANITIZE_SPECIAL_CHARS);
    if(count($errors) > 0){
        $data['errors'] = $errors;
    }
    else{
        //Procesamos
        $aux = explode(',', $_POST['numeros']);
        sort($aux);
        $data['ordenado'] = $aux;
    }
}

function checkForm(array $data) : array
{
    $errors = [];

    if(empty($data['numeros'])){
        $errors['numeros'] = 'Inserte un valor en este campo';
    }
    else{
        $aux = explode(',', $data['numeros']);
        $i = 0;
        $hayError = false;
        while($i < count($aux) && !$hayError){
            if(!is_numeric($aux[$i])){
                $hayError = true;
            }
            $i++;
        }
        if($hayError){
            $errors['numeros'] = 'Solo se permiten numeros y comas';
        }
    }
    return $errors;
}

include 'views/templates/header.php';
include 'views/iterativas02.view.php';
include 'views/templates/footer.php';

<?php
declare(strict_types=1);
$data = array();

if(isset($_POST['enviar'])){
    $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    $data['errores'] = checkForm($_POST);
    if(count($data['errores']) == 0){
        $data['resultado'] = procesarEntrada($_POST['texto']);
    }
}

function procesarEntrada(string $texto) : array {
    $textoLimpio = trim(mb_strtolower(preg_replace('/[^\p{L}]+/u',' ', $texto)));
    $palabras = preg_split("/\s+/u", $textoLimpio);
    $map = [];
    foreach ($palabras as $palabra){
        if(!isset($map[$palabra])){
            $map[$palabra] = 1;
        }
        else{
            $map[$palabra]++;
        }
    }
    arsort($map);
    return $map;
}

function checkForm(array $post) : array {
    $errores = [];
    if(empty($post['texto'])){
        $errores['texto'] = 'Este campo es obligatrio';
    }
    return $errores;
}


include 'views/templates/header.php';
include 'views/templates/iterativas05.view.php';
include 'views/templates/footer.php';

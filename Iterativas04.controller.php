<?php
declare(strict_types = 1);

$data = array();

if(isset($_POST['enviar'])){
    $data['input_texto'] = filter_var($_POST['texto'], FILTER_SANITIZE_SPECIAL_CHARS);
    $data['errores'] = checkForm($_POST);
    if(count($data['errores']) == 0){
        $data['resultado'] = procesarTexto($_POST['texto']);
    }
}

function procesarTexto(string $txt) : array {
    $resultado = [];
    //https://davidwalsh.name/letters-regex
    //regex equivalente "/[^\pL]/u"
    $txtLimpio = preg_replace("/[\P{L}]/u", '', $txt);
    //Lo pasamos a minúsculas
    $txtLimpio = mb_strtolower($txtLimpio);
    for($i = 0; $i < mb_strlen($txtLimpio); $i++){
        //Importante hacerlo así y no $txtLimpio[$i]
        $caracter = mb_substr($txtLimpio, $i, 1);
        if(!isset($resultado[$caracter])){
            $resultado[$caracter] = 1;
        }
        else{
            $resultado[$caracter]++;
        }
    }
    //Tenemos un array con clave letras y valor número de veces que aparece dica letra
    arsort($resultado);
    return $resultado;
}

function checkForm(array $datos) : array{
    $errores = [];
    if(empty($datos['texto'])){
        $errores['texto'] = 'Este campo es obligatorio';
    }
    return $errores;
}


include 'views/templates/header.php';
include 'views/templates/iterativas04.view.php';
include 'views/templates/footer.php';

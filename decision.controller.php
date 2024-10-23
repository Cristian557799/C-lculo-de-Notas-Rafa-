<?php
$data['titulo2'] = "Ejercicios con estructuras de decisión";

//Ejercicio 1
$data["div_titulo_ej1"] = "Ejercicio 1";
$data['num1'] = 13;
$data['num2'] = 4;
$data["es_divisible"] = ($data['num1'] % $data['num2'] === 0);

//Ejercicio 2
$data["div_titulo_ej2"] = "Ejercicio 2";
$data['n1'] = 7;
$data['n2'] = 15;
$data['n3'] = 14;
$data['maximo'] = max($data['n1'], $data['n2'], $data['n3']);

//Ejercicio 3
$data["div_titulo_ej3"] = "Ejercicio 3";
define('DURACION_DIA' ,  24 * 3600);
$data['ej3_input'] = 3600 * 72;
$data['dias'] = intval($data['ej3_input'] / DURACION_DIA);
$data['horas'] = intval(($data['ej3_input'] % DURACION_DIA) / 3600);
$data['minutos'] = intval(($data['ej3_input'] % 3600) / 60);
$data['segundos'] = intval(($data['ej3_input'] % 60));

//Ejercicio 4
$data["div_titulo_ej4"] = "Ejercicio 4";
$data['año'] = 1984;
$data['es_bisiesto'] = esBisiesto($data['año']);

function esBisiesto(int $year) : bool
{
    return ($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0);
}

//Ejercicio 5
$data["div_titulo_ej5"] = "Ejercicio 5";

//Común
$data['mayor_media'] = $data['neto'] > 2000;

//Ejercicio 6
$data["div_titulo_ej6"] = "Ejercicio 6";
$data['nota'] = 7.8;
$data['texto_nota'] = getCualificacionText($data['nota']);
$data['color_nota'] = getColor($data['texto_nota']);

function getCualificacionText(int|float $num) : string
{
    if($num < 0 || $num > 10) {
        throw new InvalidArgumentException("La nota debe tener un valor de entre 0 y 10");
    }
    return match(true) {
        $num < 5 => 'suspenso',
        $num < 6 => 'aprobado',
        $num < 7 => 'bien',
        $num < 8.75 => 'notable',
        $num < 10 => 'sobresaliente',
        default => 'matrícula'
    };
}

function getColor(string $nota) : string
{
    return match($nota) {
        'suspenso' => 'danger',
        'aprobado' => 'warning',
        'bien', 'notable' => 'info',
        default => 'success'
    };
}

//Ejercicio 7
$data["div_titulo_ej7"] = "Ejercicio 7";
$data['bebida'] = 'Coca-cola';
$data['tipo_bebida'] = getTipoBebida($data['bebida']);

function getTipoBebida(string $bebida) : string{

switch ($bebida) {
    case 'Marcilla':
    case 'Bonka':
        return "café";
    case 'Coca-cola':
    case 'Kas':
    case 'Pepsi':
        return 'refresco';
    case 'Mondariz':
    case 'Cabreiroá':
    case 'Sousas':
        return 'agua';
    default:
        return throw new InvalidArgumentException('Tipo de bebida no soportado');
}

}
/*
 * Llamamos a las vistas
 */
include 'views/templates/header.php';
include 'views/templates/decision.view.php';
include 'views/templates/footer.php';
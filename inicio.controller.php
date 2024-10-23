<?php
/*
 * Aquí hacemos los ejercicios y rellenamos el array de datos.
 */
$data['titulo'] = "Ejercicios Básicos";
//Ejercicio 1
$data["div_titulo_ej1"] = "Ejercicio 1";
$data['ej1_x'] = 34;
$data['ej1_y'] = $data['ej1_x'] ** 2;

//Ejercicio 2
$data["div_titulo_ej2"] = "Ejercicio 2";
$data['ej2_precio/hora'] = 50;
$data['numero_horas_ej2'] = 20.5;
$data['total_ej2'] = $data['ej2_precio/hora'] * $data['numero_horas_ej2'];

//Ejercicio 3
$data["div_titulo_ej3"] = "Ejercicio 3";
$base = 4;
$altura = 3;
$data['area_ej3'] = $base * $altura;
$data['perimetro_ej3'] = $base * 2 + $altura * 2;

//Ejercicio 4
$data["div_titulo_ej4"] = "Ejercicio 4";
$data['nombre'] = 'Antonio';
$data['edad'] = 25;
$data['nota_media'] = 8.25;

//Ejercicio 5
$data["div_titulo_ej5"] = "Ejercicio 5";
$data['precion_alta'] = 130;
$data['precion_baja'] = 70;
$data['noches_alta'] = 3;
$data['noches_baja'] = 2;
$data['total_ej5'] = $data['precion_alta'] * $data['precion_baja'] + $data['noches_alta'] * $data['noches_baja'];

//Ejercico 6
$data["div_titulo_ej6"] = "Ejercicio 6";
$radio = 4;
$data['area_ej6'] = $radio * pi() ** 2;
$data['perimetro_ej6'] = 2 * pi() ** $radio;

//Ejercicio 7
$data["div_titulo_ej7"] = "Ejercicio 7";
$data['kmh'] = 100;
$data['ms'] = $data['kmh'] * 1000 / 3600;

//Ejercicio 8
$data["div_titulo_ej8"] = "Ejercicio 8";
$data['entero'] = 341;
$data['centenas'] = intval($data['entero'] / 100);
$data['decenas'] = intval(($data['entero'] % 100) / 10);
$data['unidades'] = intval(($data['entero'] % 100) % 10);

//Ejercicio 9
$data["div_titulo_ej9"] = "Ejercicio 9";
$data["texto"] = "Hola que tal?";
$data["caracteres"] = strlen($data["texto"]);
$data["palabras"] = str_word_count($data["texto"]);

/*
 * Llamamos a las vistas
 */
include 'views/templates/header.php';
include 'views/templates/basicos.view.php';
include 'views/templates/footer.php';
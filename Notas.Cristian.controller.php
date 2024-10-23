<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Notas de Alumnos</title>
    <style>
        .error { color: red; }
        .aprobado { background-color: lightgreen; }
        .suspendido { background-color: lightyellow; }
        .promociona { background-color: lightblue; }
        .no-promociona { background-color: lightcoral; }
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 10px; }
    </style>
</head>
<body>

<h2>Formulario de Notas</h2>

<?php
//Inicializamos las variables
$jsonInput = '';
$errores = [];
$resultado = [];

//Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonInput = trim($_POST['json']); //Sanea el texto

    //Validamos la entrada
    if (empty($jsonInput)) {
        $errores[] = "El campo no puede estar vacío.";
    }else{
        $data = json_decode($jsonInput, true);

        //Comprobar si el JSON es válido
        if (json_last_error() !== JSON_ERROR_NONE) {
            $errores[] = "El JSON proporcionado no es válido.";
        }else{
            //Verificar el formato del JSON
            if (!isset($data['alumnos']) || !is_array($data['alumnos'])) {
                $errores[] = "El JSON debe contener una clave 'alumnos' que sea un array.";
            }else{
                foreach ($data['alumnos'] as $alumno) {
                    if (!isset($alumno['nombre']) || !isset($alumno['asignaturas'])){
                        $errores[] = "Cada alumno debe tener un 'nombre' y 'asignaturas'.";
                        break;
                    }

                    if (!is_array($alumno['asignaturas'])) {
                        $errores[] = "Las 'asignaturas' deben ser un array.";
                        break;
                    }
                }
            }
        }
    }

    //Si no hay errores, procesamos los datos
    if (empty($errores)) {
        procesarNotas($data);
    }
}
function procesarNotas($data) {
    global $resultado;

    foreach ($data['alumnos'] as $alumno) {
        foreach ($alumno['asignaturas'] as $asignatura => $nota) {
            if (!isset($resultado[$asignatura])) {
                $resultado[$asignatura] = [
                    'media' => 0,
                    'num_suspensos' => 0,
                    'num_aprobados' => 0,
                    'nota_max' => -1,
                    'nota_max_alumno' => '',
                    'nota_min' => 101,
                    'nota_min_alumno' => '',
                    'total_notas' => 0,
                    'cantidad' => 0
                ];
            }

            //Actualizar las estadísticas de la asignatura
            $resultado[$asignatura]['total_notas'] += $nota;
            $resultado[$asignatura]['cantidad']++;

            if ($nota >= 5) {
                $resultado[$asignatura]['num_aprobados']++;
            }else{
                $resultado[$asignatura]['num_suspensos']++;
            }

            if ($nota > $resultado[$asignatura]['nota_max']) {
                $resultado[$asignatura]['nota_max'] = $nota;
                $resultado[$asignatura]['nota_max_alumno'] = $alumno['nombre'];
            }

            if ($nota < $resultado[$asignatura]['nota_min']) {
                $resultado[$asignatura]['nota_min'] = $nota;
                $resultado[$asignatura]['nota_min_alumno'] = $alumno['nombre'];
            }
        }
    }

    //Calcular la media
    foreach ($resultado as $asignatura => &$stats) {
        $stats['media'] = $stats['total_notas'] / $stats['cantidad'];
    }

    return $data['alumnos']; // Devolver los alumnos para la vista
}

include 'views/templates/header.php';
include 'views/templates/Notas.Cristian.view.php';
include 'views/templates/footer.php';
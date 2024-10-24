<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tarea cálculo de notas</h1>

</div>
<!-- Content Row -->
<div class="row">
<?php
if(isset($data['resultado'])){
}
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Procesar Notas de Alumnos</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            /* Personalización opcional para mejorar el diseño */
            .alert { margin-bottom: 15px; }
        </style>
    </head>
    <body>

    <div class="container mt-5">
        <h1>Formulario de Notas JSON</h1>
        <?php
        include 'Notas.Cristian.controller.php'; // Incluir el controlador

        // Mostrar errores
        if (!empty($errores)) {
            echo '<div class="alert alert-danger mt-2">' . implode('<br>', $errores) . '</div>';
        }
        ?>
        <!-- Formulario -->
        <form method="POST">
            <div class="form-group">
                <label for="json">Introduce el JSON de las notas:</label>
                <textarea id="json" name="json" class="form-control" rows="10" placeholder='Ejemplo: {"alumnos": [{"nombre": "Juan", "asignaturas": {"Matemáticas": 8, "Historia": 5}}]}'><?php echo htmlspecialchars(); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Procesar</button>
        </form>

        <?php
    // Mostrar el resultado si se procesó correctamente
    if (empty($errores) && !empty($resultado)) {
        mostrarResultado($resultado, $data['alumnos']);
    }
        function mostrarResultado($resultado, $alumnos) {
        echo "<h2 class='mt-5'>Resultado</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-light'><tr><th>Módulo</th><th>Media</th><th>Aprobados</th><th>Suspensos</th><th>Máximo</th><th>Mínimo</th></tr></thead>";
        echo "<tbody>";

        foreach ($resultado as $asignatura => $datos) {
            echo "<tr>";
            echo "<td>$asignatura</td>";
            echo "<td>" . round($datos['media'], 2) . "</td>";
            echo "<td>{$datos['num_aprobados']}</td>";
            echo "<td>{$datos['num_suspensos']}</td>";
            echo "<td>{$datos['nota_max']} ({$datos['nota_max_alumno']})</td>";
            echo "<td>{$datos['nota_min']} ({$datos['nota_min_alumno']})</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";

        // Mostrar los listados de alumnos según sus notas
        listarAlumnos($alumnos);
    }


    function listarAlumnos($alumnos) {
        $aprobadoTodo = [];
        $suspendidoAlMenosUna = [];
        $promocionan = [];
        $noPromocionan = [];

        foreach ($alumnos as $alumno) {
            $num_suspensos = 0;
            foreach ($alumno['asignaturas'] as $nota) {
                if ($nota < 5) {
                    $num_suspensos++;
                }
            }

            if ($num_suspensos == 0) {
                $aprobadoTodo[] = $alumno['nombre'];
            } elseif ($num_suspensos == 1) {
                $promocionan[] = $alumno['nombre'];
            } elseif ($num_suspensos >= 2) {
                $noPromocionan[] = $alumno['nombre'];
            }

            if ($num_suspensos >= 1) {
                $suspendidoAlMenosUna[] = $alumno['nombre'];
            }
        }

        // Mostrar los listados en divs utilizando Bootstrap
        echo "<div class='row mt-4'>";
        echo "<div class='col-12 col-lg-6'><div class='alert alert-success'>Alumnos que han aprobado todo: <strong>" . implode(', ', $aprobadoTodo) . "</strong></div></div>";
        echo "<div class='col-12 col-lg-6'><div class='alert alert-warning'>Alumnos que han suspendido al menos una asignatura: <strong>" . implode(', ', $suspendidoAlMenosUna) . "</strong></div></div>";
        echo "<div class='col-12 col-lg-6'><div class='alert alert-info'>Alumnos que promocionan (máximo 1 suspenso): <strong>" . implode(', ', $promocionan) . "</strong></div></div>";
        echo "<div class='col-12 col-lg-6'><div class='alert alert-danger'>Alumnos que no promocionan (2 o más suspensos): <strong>" . implode(', ', $noPromocionan) . "</strong></div></div>";
        echo "</div>";
    }
        ?>

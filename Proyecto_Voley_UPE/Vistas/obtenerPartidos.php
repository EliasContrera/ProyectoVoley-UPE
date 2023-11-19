<?php
// Conexión a la base de datos
    $mysqli = new mysqli('localhost', 'root', '', 'bbdd_volleyup');

    if ($mysqli->connect_error) {
        die("Error en la conexión: " . $mysqli->connect_error);
    }

    // Consulta para obtener los equipos
    $result = $mysqli->query("SELECT id_equipo1, id_equipo2, fecha, id_ubicacion, pathFoto FROM partido");
    
    $partidosHTML = "<div class='row'>";

    while ($row = $result->fetch_assoc()) {

        $partidosHTML .= "<div class='col-md-6 mb-4'>";
        $partidosHTML .= "<div class='card'>";
        $partidosHTML .= "<img src='../Vistas/imagenes/estetica/{$row['pathFoto']}' class='card-img-top' alt='Partido'>";
        $partidosHTML .= "<div class='card-body'>";
        $partidosHTML .= "<h5 class='card-title'>{$row['id_equipo1']} vs {$row['id_equipo2']}</h5>";
        $partidosHTML .= "<p class='card-text'>Fecha: {$row['fecha']}</p>";
        $partidosHTML .= "<p class='card-text'>Ubicación: {$row['id_ubicacion']}</p>";
        $partidosHTML .= "</div>";
        $partidosHTML .= "</div>";
        $partidosHTML .= "</div>";
    }

    $partidosHTML .= "</div>";


    echo $partidosHTML;

    $mysqli->close();

?>

<?php
// ...

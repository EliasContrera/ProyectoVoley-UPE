<?php
// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "bbdd_volleyup");

if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

if (isset($_POST['equipoId'])) {
    $equipoId = $_POST['equipoId'];
    
    // Consulta para obtener los jugadores del equipo seleccionado
    $result = $mysqli->query("SELECT nombre, apellido,edad, altura, pathFoto FROM jugador WHERE id_equipo = $equipoId");
    
    $jugadoresHTML = "<div class='row'>";

while ($row = $result->fetch_assoc()) {

    $jugadoresHTML .= "<div class='col-md-4'>";
    $jugadoresHTML .= "<img class='Fichasimg' src='../Vistas/imagenes/jugadores/{$row['pathFoto']}' alt='{$row['nombre']}'/>";
    $jugadoresHTML .= "</div>";

    $jugadoresHTML .= "<div class='col-md-8'>";
    $jugadoresHTML .= "<div class='txtF'>";
    $jugadoresHTML .= "<p>{$row['nombre']}<br><span>{$row['apellido']}</span></p>";
    $jugadoresHTML .= "<p>Edad: {$row['edad']}</p>";
    $jugadoresHTML .= "<p>Altura: {$row['altura']} mts</p>";
    $jugadoresHTML .= "</div>";
    $jugadoresHTML .= "</div>";

}

$jugadoresHTML .= "</div>";


    echo $jugadoresHTML;
}

$mysqli->close();
?>
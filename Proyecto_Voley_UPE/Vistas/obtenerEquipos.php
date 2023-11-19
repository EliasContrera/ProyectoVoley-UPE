<?php
// Conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'bbdd_volleyup');

if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Consulta para obtener los equipos
$result = $mysqli->query("SELECT id, nombre FROM equipo");

$options = "";
while ($row = $result->fetch_assoc()) {
    $options .= "<option value='{$row['id']}'>{$row['nombre']}</option>";
}

echo $options;

$mysqli->close();

?>



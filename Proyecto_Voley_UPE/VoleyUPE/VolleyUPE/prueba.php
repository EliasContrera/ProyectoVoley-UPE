
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "";
$database = "bbdd_volleyup";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

echo "Conexión exitosa a la base de datos.";

// Verificar si el formulario se envió
if (isset($_POST['registrarme'])) {
    // Datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["passwordRegistro"];
    $fecha_edad = $_POST["fecha_edad"];

    // Consulta SQL para la inserción de datos
    $sql = "INSERT INTO USUARIO (nombre, email, password, fecha_nacimiento) VALUES ('$nombre', '$email', '$password', '$fecha_edad')";

    // Realizar la inserción
    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
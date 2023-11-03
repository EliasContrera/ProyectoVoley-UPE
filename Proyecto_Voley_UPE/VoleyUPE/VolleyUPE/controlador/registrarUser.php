<?php
require_once('../Modelo/Usuario.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["name_registro"];
    $correo = $_POST["email_registro"];
    $password = $_POST["passwordRegistro"];
    $fecha_edad = $_POST["fecha_Registro"];
    var_dump($_POST); // Esto mostrará todos los datos POST recibidos
    $usuario = new Usuario($nombre, $correo, $password, $fecha_edad);


    $resultado = $usuario->registrar(); // Intenta registrar el usuario

    if ($resultado === "Se registró nuevo usuario") {
        var_dump($_POST); // Esto mostrará todos los datos POST recibidos

        // Redirige a la página de inicio una vez que se registró el usuario
        header('Location: ../Vistas/index.html');
        exit();
    } else {
        // Maneja el caso en el que el registro no fue exitoso
        echo $resultado;
    }
} else {
    // Alguno de los campos no se envió, muestra un mensaje de error
    echo "Faltan campos en la solicitud.";
}
?>
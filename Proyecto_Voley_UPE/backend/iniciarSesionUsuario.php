<?php
include_once('clases/Usuario.php');
session_start(); // Inicia la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $password = $_POST["contraseña"];

    // Realiza una consulta para verificar si el usuario y la contraseña coinciden
    $usuario = new Usuario("", "", "", "");
    $resultado = $usuario->consultar($correo, $password);

    if ($resultado != null) {
        // Inicio de sesión exitoso, crea una variable de sesión
        $_SESSION['usuario'] = $correo;

        // Redirige al usuario a la página de inicio
        header('Location: ../frontend/index.html');
        exit();
    } else {
        // Las credenciales son incorrectas
        header('Location: ../frontend/index.html');
    }
}
?>
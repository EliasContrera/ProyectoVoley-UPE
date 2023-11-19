<?php
require_once('../Modelo/Usuario.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["name_registro"];
    $correo = $_POST["email_registro"];
    $password = $_POST["passwordRegistro"];
    $fecha_nacimiento = $_POST["fecha_Registro"];
    



    $usuario = new Usuario($correo, $password, $fecha_nacimiento, $nombre);

    $resultado = $usuario->validaRequerido($nombre, $correo, $fecha_nacimiento);

    if ($resultado !== true) {
        echo 'Error: ' . $resultado;
        return false;

    } else {
        $resultado = $usuario->registrar(); // Intenta registrar el usuario

        if ($resultado === "Se ha registrado un nuevo usuario con éxito") {
            header('Location: ../Vistas/index.php');
            exit();
        } else {
            echo $resultado;
        }
    }
}
?>
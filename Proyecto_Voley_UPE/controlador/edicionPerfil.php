<?php
require_once("../Modelo/perfil.php");
require_once("../Controlador/Permisos.php");
require_once('../controlador/IniciarSesionUsuario.php');


$usuarioID = $_SESSION['id']; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['editNombre']) ? $_POST['editNombre'] : null;
    $email = isset($_POST['editCorreo']) ? $_POST['editCorreo'] : null;
    $fechaNacido = isset($_POST['editFecha']) ? $_POST['editFecha'] : null;

    $editCompleto = new perfilUser($email, "", $fechaNacido, $nombre);

    if (empty($nombre) || empty($email) || empty($fechaNacido)) {
        echo "Debes completar todos los campos para actualizar.";
        exit();
    }else if(($resultado = $editCompleto->validaRequerido($nombre, $email, $fechaNacido)) !== true) {
        echo $resultado;
    }else if ($editCompleto->editarPerfil($usuarioID) === 'Perfil actualizado con éxito.'){
        $_SESSION['actualizacionPerfil'] = '<div class="alert alert-success">
        <strong>Actualizado!</strong> Perfil actualizado con éxito.
        </div>';
        header('Location: ../Vistas/VerPerfil.php');
        //echo "Perfil actualizado con éxito.";
    }else{
        exit();
    }
}

?>
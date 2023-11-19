<?php
require_once('../Modelo/MOD_Comentario.php');
require_once('../Controlador/iniciarSesionUsuario.php');
require_once('../controlador/Permisos.php');

$usuarioID = $_SESSION['id'];

if (!Permisos::tienePermiso('Comentar', $usuarioID) || !Permisos::esRol('usuario', $usuarioID)) {
        $_SESSION['errorcomentar'] = '<div class="alert alert-danger">
        <strong>Error!</strong> Debes tener permiso o estar registrado para poder comentar.
    </div>';
        header('Location: ../Vistas/NoticiasGeneral.php');
    exit();
    }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coment = $_POST["comentario"];
    $nombreUsuario = $_SESSION['nombre'];

    $ComentObj = new Comentarios("", "", "", "");
    $resultado = $ComentObj->AgregarComentario($usuarioID, $coment);

    if ($resultado === "Se ha agregado el comentario con éxito") {
        header('Location: ../Vistas/noticiasgeneral.php');
        exit();
    } else {
        echo $resultado;
    }
} else {
    echo "Faltan campos en la solicitud.";
}
?>
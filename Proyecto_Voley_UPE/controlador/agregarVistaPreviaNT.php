<?php
require_once("../Modelo/Usuario.php");
require_once("../Controlador/Permisos.php");
require_once("../Modelo/Noticia.php");

session_start();
$usuario = new Usuario("", "", "", "");

$usuarioID = $_SESSION['id']; 

if (!Permisos::esRol('administradorContenido', $usuarioID)) {
    // 
    echo "Debes ser administrador de contenido para agregar noticias.";
    exit();
}

if (!Permisos::tienePermiso('Agregar Noticia', $usuarioID)) {
    echo "Debes tener permiso para administrar contenido.";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoTitulo = isset($_POST['nuevo_titulo']) ? $_POST['nuevo_titulo'] : null;
    $nuevaDescripcion = isset($_POST['nuevo_texto']) ? $_POST['nuevo_texto'] : null;
    $nuevaFoto1 = isset($_POST['PathFoto1']) ? $_POST['PathFoto1'] : null;


    if (empty($nuevaDescripcion)) {
        echo "Debes completar todos los campos para actualizar la noticia.";
    } else {
        $noticia = new Noticia('', $nuevoTitulo, $nuevaDescripcion, $nuevaFoto1,'', '');

        $noticia->agregarVistaPrevia();

        echo "Noticia actualizada con éxito.";
    }
}

?>
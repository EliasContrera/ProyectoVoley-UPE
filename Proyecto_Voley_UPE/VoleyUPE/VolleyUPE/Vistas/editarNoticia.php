<?php
require_once("../Modelo/Usuario.php");
require_once("../Controlador/Permisos.php");
session_start();
$usuario = new Usuario("", "", "", "");

// Obtener el ID del usuario de la sesión o ajustar según sea necesario
$usuarioID = $_SESSION['id']; // Asegúrate de que $_SESSION['usuario_id'] se establezca correctamente

if (!Permisos::esRol('administradorContenido', $usuarioID)) {
    // 
    echo "Debes ser administrador de contenido para editar las noticias.";
    exit();
}

if (!Permisos::tienePermiso('Editar Noticia', $usuarioID)) {
    // Verifica si el usuario tiene el permiso 'editar_contenido' usando el método tienePermiso de Permisos
    echo "Debes tener permiso para editar contenido.";
    exit();
}

// Si llega hasta aquí, el usuario tiene el rol y permisos necesarios para editar noticia
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Voley UPE</title>
    <script defer src="../Vistas/script.js"></script>
    <link rel="stylesheet" href="../Vistas/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></head>
<body>

    <div id="fondo"></div>
        <!-- Incluyo la barra de navegación utilizando JavaScript -->
    <div id="navbar-container" style="padding-bottom: 3%;"></div>
    <div class="container-fluid p-5 bg-primary text-white text-center" style="padding-top: 10%;">
        <h1>Formulario Para Actualizar NOTICIA</h1>
        <p>Actualizar la Noticia correspondiente seleccionando el ID.</p> 
    </div>
    <!-- Formulario de edición de la noticia -->
    <form action="../Controlador/edicionNoticia.php" method="POST" style="padding-top: 5%">
        <div class="form-group" >
            <label for="idNoticia" class="text-black">Ingrese el ID de la noticia a editar:</label>
            <input type="number" class="form-control" id="idNoticia" name="idNoticia" value="">
        </div>
        <div class="form-group">
            <label for="nuevo_titulo" class="text-black">Nuevo Título:</label>
            <input type="text" class="form-control" id="nuevo_titulo" name="nuevo_titulo" value="">
        </div>
        <div class="form-group">
            <label for="nuevo_texto" class="text-black">Nueva Descripcion de la Noticia:</label>
            <textarea class="form-control" id="nuevo_texto" name="nuevo_texto"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>

    <footer style="padding-top: 20%">
        <!-- Incluyo el footer utilizando JavaScript -->
    </footer>
</body>
</html>
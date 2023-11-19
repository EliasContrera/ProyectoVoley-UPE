<?php

    require_once("../Modelo/Usuario.php");
    include("../Controlador/Permisos.php");
    session_start();

    $usuario = new Usuario("", "", "", "");

    // Obtener el ID del usuario de la sesión o ajustar según sea necesario
    $usuarioID = $_SESSION['id']; // Asegúrate de que $_SESSION['usuario_id'] se establezca correctamente

    if (!Permisos::esRol('administrador', $usuarioID)) {
        // Verifica si el usuario tiene el rol 'admin' usando el método esRol de Permisos
        echo "Debes ser administrador para administrar contenido.";
        exit();
    }

    if (!Permisos::tienePermiso('PanelControl_adm', $usuarioID)) {
        // Verifica si el usuario tiene el permiso 'editar_contenido' usando el método tienePermiso de Permisos
        echo "Debes tener permiso para editar contenido.";
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Voley UPE</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="stylesEquipo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div id="navbar-container" style="padding-bottom: 10%;"></div>

    <div class="container">
        <h1>Formulario de Eliminar de Jugador</h1>
        <form action="../controlador/eliminarJugador.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" name="apellido" required>
            </div>
            <button type="submit" class="btn btn-danger">Eliminar Jugador</button>
        </form>
    </div>
</body>
<script defer src="script.js"></script>

</html>

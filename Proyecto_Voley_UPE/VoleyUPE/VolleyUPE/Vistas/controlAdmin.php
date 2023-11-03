<?php
require_once("../Modelo/Usuario.php");
require_once("../Controlador/Permisos.php");
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

// Si llega hasta aquí, el usuario tiene el rol y permisos necesarios para administrar contenido
// Coloca aquí tu código para administrar contenido
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Voley UPE</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div id="navbar-container" style="padding-bottom: 10%;"></div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">ADMINISTRADOR Club Voley UPE</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../Vistas/agregarJugador.php">Agregar Jugador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eliminarJugador.php">Eliminar Jugador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buscarUsuario.php">Buscar Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eliminarUsuario.php">Eliminar Usuario</a>
                    </li> 
                </ul>
            </div>
        </div>
    </nav>
    <!-- Aquí puedes agregar el contenido principal de tu página -->
</body>
<script>src="script.js"</script>
</html>

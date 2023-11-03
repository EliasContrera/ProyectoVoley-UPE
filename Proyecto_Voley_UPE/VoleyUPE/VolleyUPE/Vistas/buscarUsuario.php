<?php
    require_once("../Modelo/Usuario.php");
    session_start();

        $usuario = new Usuario("","","","");
        $tipoUsuario = $usuario->validarRolUsuario();

    if (!isset($_SESSION['usuario']) || $tipoUsuario === 'usuario') {
        //
        echo "Debes iniciar sesión y/o ser administrador para administrar contenido.";
        exit();
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Usuario</title>
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
        <h1>Buscar usuario</h1>
        <p class="text-center">Ingresa el correo del usuario que deseas buscar.</p>

        <form action="../controlador/buscarUsuario.php" method="POST">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo del Usuario</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
            </div>
            <button type="submit" class="btn btn-secondary">Buscar</button>
            <button type="button" class="btn btn-secondary">Mostrar todos los usuarios</button>
        </form>
    </div> 
</body>
</html>
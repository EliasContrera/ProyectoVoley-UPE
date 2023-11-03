<?php

    require_once("../Modelo/Usuario.php");
    session_start();

        $usuario = new Usuario("","","","");
        $tipoUsuario = $usuario->validarRolUsuario();

    if (!isset($_SESSION['usuario']) || $tipoUsuario === 'usuario') {
        //
        echo "Debes iniciar sesión y/o ser administrador para administrar contenido.";
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
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div id="navbar-container" style="padding-bottom: 10%;"></div>
    
    <div class="container">
        <h1>Registro de Usuario</h1>
        <form action="../controlador/regisrtarUsuarioEspecial.php" method="POST">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" class="form-control" name="contraseña" required>
            </div>
            <div class="form-group">
                <label for="fecha_edad">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" name="fecha_edad" required>
            </div>
            <div class="form-group">
                <label for="id_perfil">Perfil:</label>
                <select class="form-control" name="id_perfil" required>
                    <option value="1">Administrador</option>
                    <option value="2">Administrador de contenido</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>
<script defer src="script.js"></script>

</html>

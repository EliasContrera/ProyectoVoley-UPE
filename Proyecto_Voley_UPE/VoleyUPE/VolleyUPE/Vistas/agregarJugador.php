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
    <link rel="stylesheet" href="stylesEquipo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div id="navbar-container" style="padding-bottom: 10%;"></div>

    <div class="container">
        <h1>Formulario de Registro de Jugador</h1>
        <form action="../controlador/agregarJugador.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" class="form-control" name="edad" required>
            </div>
            <div class="form-group">
                <label for="altura">Altura:</label>
                <input type="number" class="form-control" name="altura" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="id_posicion">Posición:</label>
                <select class="form-control" name="id_posicion" required>
                    <option value="1">Punta</option>
                    <option value="2">Libero</option>
                    <option value="3">Central</option>
                    <option value="4">Armador</option>
                    <option value="5">Opuesto</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id_equipo">Equipo:</label>
                <select class="form-control" name="id_equipo" required>
                    <option value="1">Jaguar</option>
                    <option value="2">Pantera</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pathFoto">Seleccionar Foto:</label>
                <input type="file" class="form-control-file" name="pathFoto" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Jugador</button>
        </form>
    </div>
</body>
</html>

<?php

    require_once("../Modelo/Usuario.php");
    include("../Controlador/Permisos.php");
    session_start();

    $usuario = new Usuario("", "", "", "");

    $usuarioID = $_SESSION['id']; 

    if (!Permisos::esRol('administrador', $usuarioID)) {
        echo "Debes ser administrador para administrar contenido.";
        exit();
    }

    if (!Permisos::tienePermiso('PanelControl_adm', $usuarioID)) {
        echo "Debes tener permiso para editar contenido.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Partido</title>
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
        <h1>Formulario agregar partido</h1>
        <form action="../controlador/agregarPartido.php" class="text-black" method="post">
           
            <div class="form-group">
                <label>Ingreese la fecha del partido:</label>
                <input type="date" class="form-control" name="fecha" required>
            </div>  

            <div class="form-group">
                <label>Ingreese la ubicación:</label>
                <input type="number" class="form-control" name="ubicacion" required>
            </div>

            <div class="form-group">
                <label >Seleccione el primer equipo:</label>
                <select class="form-control" name="equipo1" id="equipo1" required>
                    <option value="1">Jaguar</option>
                    <option value="2">Pantera</option>
                    <option value="3">Belgrano</option>
                </select>
            </div>

            <div class="form-group">
                <label>Seleccione el segundo equipo:</label>
                <select class="form-control" name="equipo2" id="equipo2" required>
                    <option value="1">Jaguar</option>
                    <option value="2">Pantera</option>
                    <option value="3">Belgrano</option>
                </select>
            </div>

            <div class="form-group">
                <label for="apellido">Ingrese puntos del primer equipo:</label>
                <input type="number" class="form-control" name="puntosGanador" required>
            </div>
          
            <div class="form-group">
                <label for="number">Ingrese puntos del segundo equipo:</label>
                <input type="number" class="form-control" name="puntosPerdedor" required>
            </div><br>
            
            <div class="form-group">
                <label>Seleccione el EQUIPO GANADOR:</label>
                <input type="number" class="form-control" name="equipoGanador" required>
            </div>


            <div class="form-group">
                <label>Seleccione el EQUIPO PERDEDOR:</label>
                <input type="number" class="form-control" name="equipoPerdedor" required>
            </div>

        
            <div class="form-group">
                <label for="pathFoto">Seleccionar Foto:</label>
                <input type="file" class="form-control-file" name="pathFoto" accept="image/*" required>
            </div><br>

            <button type="submit" class="btn btn-primary">Registrar Jugador</button>
        </form>
    </div>
</body>
</html>
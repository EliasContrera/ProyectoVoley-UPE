<?php
    require_once("../Modelo/Usuario.php");
    require_once("../Controlador/Permisos.php");
    session_start();

    $usuario = new Usuario("", "", "", "");

    $usuarioID = $_SESSION['id']; //
    
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
    <title>Club Voley UPE</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">ADMINISTRADOR</a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="agregarEquipo.php">Agregar Equipo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agregarPartido.php">Agregar Partido</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Salir</a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav>
     <div class="container mt-5">
        <div class="row">
            <div class="col-sm-4 border">
                <h4 class="text-center">Buscar jugador</h4>
                <form action="../controlador/buscarJugador.php" method="post">
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
                        <label for="id_equipo">Equipo:</label>
                        <select class="form-control" name="id_equipo" required>
                            <option value="1">Jaguar</option>
                            <option value="2">Pantera</option>
                        </select>
                    </div><br>
                    <button type="submit" class="btn btn-outline-warning">Buscar</button><br>
                </form>
               
            </div>
        </div>
    </div>

</body>
<script>src="script.js"</script>
</html>

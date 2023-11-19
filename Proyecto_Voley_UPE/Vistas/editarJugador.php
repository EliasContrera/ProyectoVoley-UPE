<?php
    require_once("../Modelo/Usuario.php");
    include("../Modelo/Jugador.php");
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
    if(isset($_SESSION['jugadorEncontrado'])) {
            // Obtener el objeto de la persona encontrada desde la sesión
        $jugadorEncontrado = $_SESSION['jugadorEncontrado'];
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="../Vistas/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container">
        <h1>editar datos del Jugador <?php echo $jugadorEncontrado->getnombre();?></h1>
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
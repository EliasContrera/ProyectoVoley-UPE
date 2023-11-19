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
    <title>Editar jugadort</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="../Vistas/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="alert alert-success">
    <strong>Encontrado!</strong>Jugador existente</a>.
    </div>
    <div class="container p-5 my-5 bg-secundary text-black border" class="row">
        <div class="col-md-6">
            <h4 class='text-center'>Datos Personales Jugador: <?php echo $jugadorEncontrado->getnombre();?></h4>
            <ul class="list-group">
                <li class="list-group-item list-group-item-action list-group-item-secondary"><strong>Nombre:</strong> <?php echo $jugadorEncontrado->getnombre(); ?></li>
                <li class="list-group-item list-group-item-action list-group-item-secondary"><strong>Apellido:</strong> <?php echo $jugadorEncontrado->getapellido(); ?></li>
                <li class="list-group-item list-group-item-action list-group-item-secondary"><strong>Edad:</strong> <?php echo $jugadorEncontrado->getedad(); ?></li>
                <li class="list-group-item list-group-item-action list-group-item-secondary"><strong>Altura:</strong> <?php echo $jugadorEncontrado->getaltura(); ?></li>
                <li class="list-group-item list-group-item-action list-group-item-secondary"><strong>Posicion:</strong> <?php echo $jugadorEncontrado->getposicion(); ?></li>
                <li class="list-group-item list-group-item-action list-group-item-secondary"><strong>Equipo:</strong> <?php echo $jugadorEncontrado->getequipo(); ?></li>
                <li class="list-group-item list-group-item-action list-group-item-secondary"><strong>Foto:</strong> <?php echo $jugadorEncontrado->getfoto(); ?></li>   
            </ul><br>

            <a href="../Vistas/controlAdmin.php" button type="button" class="btn btn-outline-primary">Volver</button></a>
            <a href="../Vistas/editarJugador.php" button type="button" class="btn btn-outline-primary">Editar datos</button></a>
        </div>
    </div>  
    
</body>
</html>
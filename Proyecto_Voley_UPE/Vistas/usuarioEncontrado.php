<?php
    include("../Modelo/Usuario.php");
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
      // Verificar si el objeto de la persona encontrada está en la sesión
    if(isset($_SESSION['usuarioEncontrado'])) {
        // Obtener el objeto de la persona encontrada desde la sesión
        $usuarioEncontrado = $_SESSION['usuarioEncontrado'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios existentes</title>
    <script defer src="script.js"></script>
    <script defer src="scriptForm.js"></script>
    <link rel="stylesheet" href="../Vistas/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container p-5 my-5 bg-secundary text-black border" class="row">
        <div class="col-md-6">
            <h4 class='text-center'>Datos Personales</h4>
            <ul class="list-group">
                <li class="list-group-item list-group-item-action list-group-item-secondary"><strong>Mail:</strong> <?php echo $usuarioEncontrado->getcorreo(); ?></li>
                <li class="list-group-item list-group-item-action list-group-item-secondary"><strong>Fecha de nacimiento:</strong> <?php echo $usuarioEncontrado->getfecha(); ?></li>
            </ul><br>
            <a href="../Vistas/controlAdmin.php" button type="button" class="btn btn-outline-primary">Volver</button></a>
        </div>
    </div>
</body>
</html>
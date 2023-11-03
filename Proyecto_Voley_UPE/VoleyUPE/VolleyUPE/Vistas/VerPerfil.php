<?php
    require_once("../Modelo/Usuario.php");
    include('../controlador/IniciarSesionUsuario.php');

    if (isset($_SESSION['usuario'])) {
        $usuario = $_SESSION['usuario'];
        $contra = $_SESSION['password'];
        $usuarioId = $_SESSION['id']; // Agregamos esta línea para obtener el ID
        $nombreUser = $_SESSION['nombre'];
    } else {
        echo "Debes iniciar sesión para ver tu perfil.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="stylesNoticia.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div id="fondo"></div>
    <!-- Incluyo la barra de navegación utilizando JavaScript -->
    <div id="navbar-container" style="padding-top: 3%;"></div>

    <p class="text-white">
        ID: <?php echo $usuarioId; ?></br>
        Nombre: <?php echo $nombreUser; ?></br>
        Correo: <?php echo $usuario; ?></br>
        Contraseña: <?php echo $contra; ?>
    </p>

    <footer style="padding-top: 30%;">
        <!-- Incluyo el footer utilizando JavaScript -->
        <div id="footer-container"></div>
    </footer>
</body>
</html>


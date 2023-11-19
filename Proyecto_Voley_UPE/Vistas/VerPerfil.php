<?php
    require_once("../Modelo/perfil.php");
    require_once('../controlador/IniciarSesionUsuario.php');
    require_once('../controlador/Permisos.php');

    $mensaje = null;
    if (isset($_SESSION['actualizacionPerfil']) && $_SESSION['actualizacionPerfil']){
        $mensaje = $_SESSION['actualizacionPerfil'];
        unset($_SESSION['actualizacionPerfil']);
    }
    
    if (isset($_SESSION['usuario'])) {
        $usuarioId = $_SESSION['id']; 

        try {
            $conexion = new PDO("mysql:host=localhost;dbname=bbdd_volleyup", "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $idUsuario = $usuarioId;
        
            $sql = "SELECT fecha_nacimiento, nombre, email FROM usuario WHERE id = :id";
            $stmt = $conexion->prepare($sql);
        
            $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
        
            $stmt->execute();
        
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($resultado) {
                $fechaNacimiento = $resultado['fecha_nacimiento'];
                $nombreUser = $resultado['nombre'];
                $correoUser = $resultado['email'];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    } else {
        echo "Debes iniciar sesión para ver tu perfil.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
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
    
    <div class="container mt-5 text-center">
        <div class="row text-center">
            <div class="">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $nombreUser; ?></h5>
                        <p class="card-text">
                            Fecha de Nacimiento: <?php echo $fechaNacimiento?><br>
                            ID: <?php echo $usuarioId; ?><br>
                            Correo: <?php echo $correoUser; ?><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
         <p><?php echo $mensaje ?></p>
        </div>
    </div>



    <footer style="padding-top: 25%;">
        <div id="footer-container"></div>
    </footer>
</body>
</html>


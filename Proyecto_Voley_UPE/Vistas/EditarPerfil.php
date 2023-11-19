<?php
    require_once("../Modelo/Usuario.php");
    require_once("../Modelo/perfil.php");
    require_once('../controlador/IniciarSesionUsuario.php');
    require_once('../controlador/Permisos.php');

    $usuarioID = $_SESSION['id']; // 


    if (!Permisos::tienePermiso('Editar Perfil', $usuarioID)) {
        echo'Debes tener permiso para editar el perfil';
        //header('Location: ../Vistas/index.php'); //No dejo que el usuario entre a la seccion de edicion de perfil
        exit();
    }

    

    if (isset($_SESSION['usuario'])) {
        $usuario = $_SESSION['usuario'];
        $contra = $_SESSION['password'];
        $usuarioId = $_SESSION['id']; 
        $nombreUser = $_SESSION['nombre'];

        ///////////////////////////
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
        
        $conexion = null;
        //////////////////////////////////////////
    } else {
        echo "Debes iniciar sesión para editar tu perfil.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edicion Perfil Usuario</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script defer src=".js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div id="fondo"></div>
    <!-- Incluyo la barra de navegación utilizando JavaScript -->
    <div id="navbar-container" style="padding-bottom: 5%;"></div>

    <div class="container mt-3 card">
     <h5 class="card-title">USUARIO: <?php echo $nombreUser?></h5>
            <form action="../controlador/edicionPerfil.php" class="text-black" id="edicionPerfil" method="post">
                <div class="mb-3 mt-3">
                    <label for="editNombre">Nombre de Usuario:</label>
                    <input type="text" class="form-control" id="editNombre" placeholder="<?php echo $nombreUser; ?>" name="editNombre">
                    <div class="invalid-feedback">Formato de nombre de usuario invalido (Debe contener maximo 1 palabra y solo letras).</div>

                </div>
                <div class="mb-3">
                    <label for="editCorreo">Direccion de Correo:</label>
                    <input type="email" class="form-control" id="editCorreo" placeholder="<?php echo $correoUser; ?>" name="editCorreo">
                    <div class="invalid-feedback">Formato de correo electronico invalido.</div>

                </div>
                <div class="mb-3">
                    <label for="editFecha">Fecha de Nacimiento:</label>
                    <input type="date" required class="form-control" id="editFecha" value="<?php echo $fechaNacimiento ?>" name="editFecha">
                    <div class="invalid-feedback">Fecha de nacimiento inválida (debe ser mayor de 18 años su edad).</div>
                </div>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><a class="linkBoton" href="../Vistas/VerPerfil.php">Cancelar</a></button>
                <button type="submit" class="btn btn-primary" id="Guardar" name="Guardar">Guardar Cambios</button>
            </form>
</div>  

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">

                        <p class="card-text">
                            ID: <?php echo $usuarioId; ?><br>
                            Correo: <?php echo $usuario; ?><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer style="padding-top: 30%;">
        <!-- Incluyo el footer utilizando JavaScript -->
        <div id="footer-container"></div>
    </footer>
</body>
</html>
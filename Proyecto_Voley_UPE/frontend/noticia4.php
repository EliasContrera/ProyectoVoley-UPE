<?php
    include_once('../backend/clases/Usuario.php');

    session_start();

    // Inicializa las variables
    $correoUsuario = $passwordUsuario = $fechaNacimientoUsuario = $idPerfilUsuario = '';
    
    if (isset($_SESSION['usuario'])) {
        // Obtén el correo del usuario desde la sesión
        $correoUsuario = $_SESSION['usuario'];
    
        // Realiza una consulta a la base de datos para obtener los datos del usuario
        $conexion = new mysqli("localhost", "root", "", "bbdd_voleyup");
    
        if ($conexion->connect_error) {
            die("Error en la conexión a la base de datos: " . $conexion->connect_error);
        }
    
        $sql = "SELECT * FROM usuario WHERE correo = '$correoUsuario'";
        $resultado = $conexion->query($sql);
    
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            // Asigna los valores de la base de datos a las variables correspondientes
            $correoUsuario = $fila["correo"];
            $passwordUsuario = $fila["password"];
            $fechaNacimientoUsuario = $fila["fecha_nacimiento"];
            $idPerfilUsuario = $fila["id_perfil"];
        } else {
            echo "Usuario no encontrado en la base de datos.";
        }
    
        $conexion->close();
    } else {
        // El usuario no ha iniciado sesión
        // Aquí puedes manejar este caso, por ejemplo, mostrando un mensaje de error o redirigiendo al usuario.
    }
    
    // Luego, puedes usar los valores que obtuviste de la base de datos
    $usuario = new Usuario($correoUsuario, $passwordUsuario, $fechaNacimientoUsuario, $idPerfilUsuario);
    $tipoUsuario = $usuario->validarRolUsuario();
    
    // Aquí ya puedes usar la variable $tipoUsuario

    // Realiza la conexión a la base de datos y verifica la conexión (deberías tener un código de conexión similar al que usaste en otras partes de tu aplicación)
    $conexion = new mysqli("localhost", "root", "", "bbdd_voleyup");

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Realiza una consulta para obtener los datos de la noticia desde la base de datos
    $sql = "SELECT titulo, descripcion FROM noticia WHERE id = ?"; // Reemplaza 'id' por el nombre de tu columna de identificación
    $idNoticia = 4; // Reemplaza esto por el ID de la noticia que deseas mostrar
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idNoticia); // "i" indica que es un valor entero

    if ($stmt->execute()) {
        $stmt->bind_result($titulo, $parrafo);
        $stmt->fetch();
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La UPE presente - JUAR 2023</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="stylesLink.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div id="fondo"></div>
    <!-- Incluyo la barra de navegación utilizando JavaScript -->
    <div id="navbar-container" style="padding-top: 2%;"></div>

    <!-- Modales de inicio de sesion y registro, los incluyo ocn javascript -->
    <div id="modal-container"></div>
        <!-- Botón de edición para administradores -->

        <div class="text-center"> <!-- Centro el contenido -->

        <img class="imagen img-fluid" src="./imagenes/juar2023.jpg" alt="juar2023" >
            <?php
                if (isset($_SESSION['usuario']) && $tipoUsuario === 'administrador') {
                    echo '<a href="editarNoticia.php"  class="btn btn-primary">Editar Noticia</a>';
                }
            ?>
            <h3><?php echo $titulo; ?></h3>
            <p class="text-white text-center" ><?php echo $parrafo; ?></p>
            <img class="imagen img-fluid" src="./imagenes/2dolugar.png" alt="2dolugar" style="width: 70%; height: 100%;">
        </div>
    <footer>
        <!-- Incluyo el footer utilizando JavaScript -->
        <div id="footer-container"></div>
    </footer>
</body>
</html>
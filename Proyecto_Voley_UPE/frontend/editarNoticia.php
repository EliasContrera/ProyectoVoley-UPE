<?php
    // Incluye el archivo de conexión para acceder a la variable $BaseSTOCK
    include_once("../backend/clases/Usuario.php");
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
    }
    
    // uso los valores q  obtuve de la base de datos
    $usuario = new Usuario($correoUsuario, $passwordUsuario, $fechaNacimientoUsuario, $idPerfilUsuario);
    $tipoUsuario = $usuario->validarRolUsuario();

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Validacion para que no se pueda acceder a la edicion a menos que se haya iniciado sesion y sea un administrador.

    if (!isset($_SESSION['usuario']) || $tipoUsuario === 'usuario') {
        // Si el usuario no ha iniciado sesión, puedes redirigirlo o mostrar un mensaje de error
        echo "Debes iniciar sesión y/o ser administrador para editar noticias.";
        exit();
    }
    
    // Crea una instancia de la clase Usuario para manejar la lógica
    $formulario = new Usuario('', '', '', ''); //
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recupera los datos del formulario
        $idNoticia = isset($_POST['idNoticia']) ? $_POST['idNoticia'] : null;
        $nuevo_titulo = isset($_POST['nuevo_titulo']) ? $_POST['nuevo_titulo'] : null;
        $nuevo_texto = isset($_POST['nuevo_texto']) ? $_POST['nuevo_texto'] : null;
    
        
        if (empty($nuevo_titulo) && empty($nuevo_texto)) {
            echo "Debes ingresar al menos un título o una descripción para actualizar la noticia.";
        } else {
            // Llama al método para actualizar la noticia solo si se proporcionan datos válidos
            $formulario->actualizarNoticia($idNoticia, $nuevo_titulo, $nuevo_texto);
            header("Location: noticia1.php");
        }


    }
// Resto del código HTML que muestra el formulario
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Voley UPE</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="stylesLink.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></head>
<body>

    <div id="fondo"></div>
        <!-- Incluyo la barra de navegación utilizando JavaScript -->
    <div id="navbar-container" style="padding-bottom: 5%"></div>

    <!-- Modales de inicio de sesion y registro, los incluyo ocn javascript -->
    <div id="modal-container"></div>
    <!-- Formulario de edición de la noticia -->
    <form method="POST" style="padding-bottom: 21%">
    <div class="form-group" >
            <label for="idNoticia" class="text-white">Ingrese el ID de la noticia a editar:</label>
            <input type="number" class="form-control" id="idNoticia" name="idNoticia" value="">
        </div>
        <div class="form-group">
            <label for="nuevo_titulo" class="text-white">Nuevo Título:</label>
            <input type="text" class="form-control" id="nuevo_titulo" name="nuevo_titulo" value="">
        </div>
        <div class="form-group">
            <label for="nuevo_texto" class="text-white">Nueva Descripcion de la Noticia:</label>
            <textarea class="form-control" id="nuevo_texto" name="nuevo_texto"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>

    <footer>
            <!-- Incluyo el footer utilizando JavaScript -->
            <div id="footer-container"></div>
        </footer>
</body>
</html>
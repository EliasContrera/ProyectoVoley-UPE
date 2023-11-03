<?php
require_once("../Modelo/Usuario.php");
require_once("../Controlador/Permisos.php");
require_once("../Controlador/iniciarSesionUsuario.php");


// Reemplaza esta línea con la lógica necesaria para validar la sesión y obtener el ID de usuario


// Inicializa las variables en ''
$correoUsuario = $passwordUsuario = $fechaNacimientoUsuario = $idPerfilUsuario = '';
// Conéctate a la base de datos
$conexion = new mysqli("localhost", "root", "", "bbdd_volleyup");
$usuario = new Usuario("", "", "", "");

// Obtén la ID de la noticia principal desde la URL
$idNoticiaPrincipal = isset($_GET['id']) ? $_GET['id'] : null;

if ($idNoticiaPrincipal === null) {
    // Redirige o muestra un mensaje en caso de que no se proporcione una ID válida
    header("Location: noticias.php"); // Redirige a la página de noticias o muestra un mensaje de error
    exit;
}

// Realiza una consulta para obtener los detalles de la noticia en función de la ID de la noticia principal
$sql = "SELECT Noticias.Titulo, Noticias.Descripcion, Noticias.PathFoto1, Noticias.PathFoto2 FROM Noticias 
        WHERE Noticias.IdNoticiaPrincipal = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idNoticiaPrincipal); // "i" indica que es un valor entero

if ($stmt->execute()) {
    $stmt->bind_result($titulo, $parrafo, $nombreImagen, $nombreImagen2);
    $stmt->fetch();
}
$conexion->close(); // Cierra la conexión a la base de datos
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de la Noticia</title>
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
    <!-- Incluye la barra de navegación utilizando JavaScript -->
    <div id="navbar-container" style="padding-bottom: 3%;"></div>

    <div class="text-center"> 

        <img class="imagen img-fluid" src="./imagenes/noticias/<?php echo $nombreImagen; ?>" alt="imagen_noticia" style="max-width: 40%; height: auto;">

        <h3><?php echo $titulo; ?></h3>
        <p class="text-white"><?php echo $parrafo; ?></p>
        <img class="imagen img-fluid" src="./imagenes/noticias/<?php echo $nombreImagen2; ?>" alt="imagen_noticia" style="max-width: 40%; height: auto;">
    </div>
    <footer>
        <!-- Incluye el footer utilizando JavaScript -->
        <div id="footer-container"></div>
    </footer>
</body>
</html>
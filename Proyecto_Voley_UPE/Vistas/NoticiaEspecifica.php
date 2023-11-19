<?php
require_once("../Modelo/Usuario.php");
require_once("../Controlador/Permisos.php");
require_once("../Controlador/iniciarSesionUsuario.php");

try {
    $dsn = "mysql:host=localhost;dbname=bbdd_volleyup";
    $usuarioDB = "root";
    $contrasenaDB = "";

    $conexionPDO = new PDO($dsn, $usuarioDB, $contrasenaDB);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}


$idNoticiaPrincipal = isset($_GET['id']) ? $_GET['id'] : null;

if ($idNoticiaPrincipal === null) {
    header("Location: noticias.php"); 
    exit;
}

$sql = "SELECT Noticias.Titulo, Noticias.Descripcion, Noticias.PathFoto1, Noticias.PathFoto2 FROM Noticias 
        WHERE Noticias.IdNoticiaPrincipal = :idNoticiaPrincipal";
$stmt = $conexionPDO->prepare($sql);
$stmt->bindParam(':idNoticiaPrincipal', $idNoticiaPrincipal, PDO::PARAM_INT);

try {
    $stmt->execute();

    $noticia = $stmt->fetch(PDO::FETCH_ASSOC);

    $titulo = $noticia['Titulo'];
    $parrafo = $noticia['Descripcion'];  //Las variables almacenan los datos de la tnoticia
    $nombreImagen = $noticia['PathFoto1'];
    $nombreImagen2 = $noticia['PathFoto2'];

} catch (PDOException $e) {
    // Manejar errores de consulta
    echo "Error de consulta: " . $e->getMessage();
    exit();
}

$conexionPDO = null;
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


    <div class="container text-center"> <!--Muestro en la pagina lo que traje de la base de datos -->
        <img class="imagen img-fluid" src="<?php echo $nombreImagen; ?>" alt="noticiaPrincipal" style="max-width: 40%; height: auto;">

        <h1><?php echo $titulo; ?></h1>
        <p class="text-white"><?php echo $parrafo; ?></p>
        <img class="imagen img-fluid" src="./imagenes/noticias/<?php echo $nombreImagen2; ?>" alt="VistaPreviasNoticias" style="max-width: 40%; height: auto;">
    </div>
    <footer>
        <!-- Incluye el footer utilizando JavaScript -->
        <div id="footer-container"></div>
    </footer>
</body>
</html>
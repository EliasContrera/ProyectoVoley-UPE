<?php
require_once("../Modelo/Usuario.php");

session_start();

// Inicializa las variables en ''
$correoUsuario = $passwordUsuario = $fechaNacimientoUsuario = $idPerfilUsuario = '';
// Conéctate a la base de datos
$conexion = new mysqli("localhost", "root", "", "bbdd_volleyup");
$usuario = new Usuario("", "", "", "");

// Realiza una consulta para obtener los datos de las noticias principales desde la base de datos
$sql = "SELECT id, titulo, descripcion, pathFoto FROM NoticiasPrincipales";
$resultado = $conexion->query($sql);

// Comprueba si la consulta se ejecutó correctamente
if ($resultado) {
    $noticiaPrincipal = null;
    $noticiasRestantes = [];

    // Itera sobre los resultados y almacena la noticia principal y las noticias restantes
    while ($row = $resultado->fetch_assoc()) {
        $idNoticia = $row['id']; // Obtén el id de la noticia
        $titulo = $row['titulo'];
        $descripcion = $row['descripcion'];
        $pathFoto = $row['pathFoto'];

        if ($noticiaPrincipal === null) {
            $noticiaPrincipal = [
                'id' => $idNoticia,
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'pathFoto' => $pathFoto
            ];
        } else {
            $noticiasRestantes[] = [
                'id' => $idNoticia,
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'pathFoto' => $pathFoto
            ];
        }
    }

    $resultado->free(); // Libera el resultado
}

$conexion->close(); // Cierra la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias - Club Voley UPE</title>
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

    <!-- Barra de Navegación -->
    <div id="navbar-container"></div><br>


    <!-- Noticia Principal -->
    <div class="noticia-principal">
        <a title="noticiaPrincipal" href="noticia.php?id=<?php echo $noticiaPrincipal['id']; ?>">
            <img class="img-fluid" src="<?php echo $noticiaPrincipal['pathFoto']; ?>" alt="imagen_noticia">
        </a>
        <div class="texto-superpuesto">
            <h3><?php echo $noticiaPrincipal['titulo']; ?></h3>
            <p><?php echo $noticiaPrincipal['descripcion']; ?></p>
        </div>
    </div>

    <!-- Resto de las noticias -->
    <div class="container mt-5">
        <div class="row">
                <?php
                    foreach ($noticiasRestantes as $noticia) {
                ?>
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <a title="noticia<?php echo $noticia['titulo']; ?>" href="noticia.php?id=<?php echo $noticia['id']; ?>">
                                            <img class="imagen" src="<?php echo $noticia['pathFoto']; ?>" alt="imagen_noticia">
                                        </a>
                                        <div class="texto-superpuesto">
                                            <h3><?php echo $noticia['titulo']; ?></h3>
                                            <p><?php echo $noticia['descripcion']; ?></p>
                                        </div>
                                    </div>
                                </div>
                <?php
                }
                ?>
        </div>
    </div>

    <!-- Sección de Comentarios -->
    <div id="comentarios" class="container mt-4">
        <h2>Comentarios</h2>
        <div class="row">
            <div class="col-md-8">
                <!-- Formulario para agregar comentarios -->
                <h3>Agregar Comentario</h3>
                <form id="comentarios-form">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Tu Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario:</label>
                        <textarea class="form-control" id="comentario" rows="4" placeholder="Escribe tu comentario" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Publicar Comentario</button>
                </form>
            </div>
        </div>

        <!-- Lista de Comentarios -->
        <div class="row mt-4">
            <div class="col-md-8">
                <h3>Comentarios Recientes</h3>
                <ul id="lista-comentarios" class="list-unstyled">
                    <!-- Los comentarios se agregarán acá de forma dinámica con JavaScript -->
                </ul>
            </div>
        </div>
        <button type="button" class="btn btn-danger" name="report" id="report">Denunciar Comentario</button>
    </div>
</div>

<footer>
    <!-- Incluyo el footer utilizando JavaScript -->
    <div id="footer-container"></div>
</footer>

</body>
</html>
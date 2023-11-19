<?php

require_once("../Modelo/Usuario.php");
require_once("../Modelo/perfil.php");
require_once('../controlador/IniciarSesionUsuario.php');
require_once('../controlador/Permisos.php');

$idUSERxd = null;
$mensaje = null;
$error = null;

if (isset($_SESSION['usuario']) && $_SESSION['usuario']){
    $idUSERxd = $_SESSION['id']; //
}
if (isset($_SESSION['mensaje']) && $_SESSION['mensaje']){
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['errorcomentar']) && $_SESSION['errorcomentar']){
    $error = $_SESSION['errorcomentar'];
    unset($_SESSION['errorcomentar']);
}

try {
    $dsn = "mysql:host=localhost;dbname=bbdd_volleyup";
    $usuarioDB = "root";
    $contrasenaDB = "";

    $conexionPDO = new PDO($dsn, $usuarioDB, $contrasenaDB);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}

// Consulta para obtener los datos de las noticias principales desde la base de datos
$sql = "SELECT id, titulo, descripcion, pathFoto FROM NoticiasPrincipales";
$stmt = $conexionPDO->query($sql);

    if ($stmt) { 
        $noticiaPrincipal = null;
        $noticiasRestantes = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $idNoticia = $row['id'];
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
        $stmt->closeCursor();
    }

$conexionPDO = null; // Cierra la conexión PDO
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
    <script defer src="scriptComentariosAJAX.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div id="fondo"></div>
    <div style="padding-bottom: 5%;" id="navbar-container">
    </div><br>
    <h1 class="text-white"><?php echo $mensaje ?></h1>
    <!-- Noticia Principal, traje los datos desde la bbdd-->
    <div class="noticia-principal   ">
        
        <a title="noticiaPrincipal" href="NoticiaEspecifica.php?id=<?php echo $noticiaPrincipal['id']; ?>">
            <img class="img-fluid" src="../Vistas/imagenes/noticias/<?php echo $noticiaPrincipal['pathFoto']; ?>" alt="NoticiaPrincipal">
        </a>
        <div class="texto-superpuesto">
            <h3><?php echo $noticiaPrincipal['titulo']; ?></h3>
            <p><?php echo $noticiaPrincipal['descripcion']; ?></p>
        </div>
    </div>

    <!-- Resto de las noticias, traje los datos desde la bbdd -->
    <div class="container mt-5">
        <div class="row">
                <?php
                    foreach ($noticiasRestantes as $noticia) {
                ?>
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <a title="noticia<?php echo $noticia['titulo']; ?>" href="NoticiaEspecifica.php?id=<?php echo $noticia['id']; ?>"> <!--De los datos que obtuve, los muestro en pantalla -->
                                            <img class="imagen" src="<?php echo $noticia['pathFoto']; ?>" alt="VistaPrevias">
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
    
    <div class="container text-left">
    <?php
        if (Permisos::tienePermiso('Agregar Noticia', $idUSERxd)) {
            echo '
                    <button class="btn btn-primary"><a class="nav-link text-white" href="../Vistas/View_AgregarNoticia.php">Agregar Noticias</a></button>
                ';
        }
    ?>
        <?php
        if (Permisos::tienePermiso('Agregar Noticia', $idUSERxd)) {
            echo '
                <button class="btn btn-primary"><a class="nav-link text-white" href="../Vistas/AgregarVistaPreviaVIEW.php">Agregar Vista Previa</a></button>
            ';
        }
    ?>
    </div>




    <!-- Sección de Comentarios -->
    <div id="comentarios" class="container mt-4 text-black" >
        <h2 class="text-black">Comentarios</h2>
        <div class="row">
            <div class="col-md-8">
                <!-- Formulario para agregar comentarios -->
                <h3>Agregar Comentario</h3>
                <form action="../controlador/CON_Comentarios.php" method="post" id="comentarios-form">
                    <div class="form-group">
                        <label for="comentario">Comentario:</label>
                        <textarea class="form-control" id="comentario" name="comentario" rows="4" placeholder="Escribe tu comentario" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Publicar Comentario</button>
                </form>


                <p><?php echo $error ?></p>
            </div>
        </div>

        <!-- Lista de Comentarios -->
        <div id="seccion-comentarios" class="row mt-4">
            <div class="col-md-8">
                <h3>Comentarios Recientes</h3>
                <ul id="lista-comentarios" class="list-unstyled">
                    <!-- Los comentarios se ponen acá de forma dinámica con JavaScript usando AJAX -->
                </ul>
                <button type="button" class="btn btn-danger" name="report" id="report">Denunciar Comentario</button>
            </div>
        </div>       
    </div>
                
</div>

<footer>
    <!-- Incluyo el footer utilizando JavaScript -->
    <div id="footer-container"></div>
</footer>

</body>
</html>
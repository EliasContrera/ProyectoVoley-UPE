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

    <!-- Modales de inicio de sesion y registro, los incluyo ocn javascript -->
    <div id="modal-container"></div>

    <div class="noticia-principal">
        <a title="noticiaPrincipal" href="noticiaPrincipal.php"><img class="img-fluid" src="./imagenes/upevsunqui.jpg" alt="upevsunqui"></a>
        <div class="texto-superpuesto">
            <h3>EQUIPO UPE vs. UNQUI</h3>
            <p>Debido a la baja de los titulares, los suplentes...</p>
        </div>
    </div>


    <!-- Resto de las noticias -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="noticiaReciente">Noticias Recientes</h2>
            </div>
        </div>
        
        <div class="container mt-5" id="noticias">
            <div class="row">
                <!-- Noticia 1 -->
                <div class="col-md-6">
                    <div class="card mb-4">
                    <a title="noticia1" href="noticia1.php"><img class="imagen" src="./imagenes/medalla.jpg" alt="medalla"></a>
                        <div class="texto-superpuesto">
                            <h3>La UPE presente - JUAR 2023</h3>
                            <p>La Secretaria de Extensión y Bienestar Universitario de la UPE, Lic. Ayelén Rocha...</p>
                        </div>
                    </div>
                </div>

                <!-- Noticia 2 -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <a title="noticia2" href="noticia2.php"><img class="imagen" src="./imagenes/jupla.jpg" alt="jupla"></a>
                        <div class="texto-superpuesto">
                            <h3>La UPE en los Juegos JUPLA 2022</h3>
                            <p>La UPE participó de la edición 2022 de los Juegos Universitarios de Playa (JUPLA),...</p>
                        </div>
                    </div>
                </div>

                <!-- Noticia 3 -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <a title="noticia3" href="noticia3.php"><img class="imagen" src="./imagenes/2dolugar.png" alt="2dolugar"></a>
                        <div class="texto-superpuesto">
                            <h3>Reconocimiento a Deportistas de la UPE</h3>
                            <p>En el día de hoy se reconoció a los y las deportistas de la Universidad Provincial de Ezeiza...</p>
                        </div>
                    </div>
                </div>

                <!-- Noticia 4 -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <a title="noticia4" href="noticia4.php"><img class="imagen" src="./imagenes/salud.jpg" alt="salud"></a>
                        <div class="texto-superpuesto">
                            <h3>Semana de la Salud y el Deporte en la UPE</h3>
                            <p>La Semana de la Salud y el Deporte se lleva a cabo en la Universidad Provincial de Ezeiza...</p>
                        </div>
                    </div>
                </div>
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
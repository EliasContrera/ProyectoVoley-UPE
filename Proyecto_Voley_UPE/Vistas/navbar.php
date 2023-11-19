<?php
require_once("../Modelo/Usuario.php");
require_once("../Controlador/Permisos.php");
require_once("../Modelo/perfil.php");
require_once("../controlador/iniciarSesionUsuario.php");

$usuario_id = null;

if (isset($_SESSION['usuario']) && $_SESSION['usuario']){
    $usuario_id = $_SESSION['id']; // 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <script defer src="script.js"></script>
    <script defer src="scriptForm.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <!-- Barra de Navegacion -->
    <div class="fixed-top" id="cabecera">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="../Vistas/imagenes/estetica/voleyballworld.png" alt="voley logo" style="width:40px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" id="inicio">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item" id="Equipo">
                            <a class="nav-link" href="equipo.html">Equipo</a>
                        </li>
                        <li class="nav-item" id="Noticias">
                            <a class="nav-link" href="NoticiasGeneral.php">Noticias</a>
                        </li>
                        <li class="nav-item" id="Partidos">
                            <a class="nav-link" href="partido.html">Partidos</a>
                        </li>

                        <!-- Verificar si el usuario tiene permisos"" -->
                        <?php
                        if (Permisos::tienePermiso('PanelControl_adm', $usuario_id)) {
                            echo '<li class="nav-item" id="Admin">
                                    <a class="nav-link" href="../Vistas/controlAdmin.php">Panel de Control</a>
                            </li>';
                        }
                        ?>
                        <?php
                        if (Permisos::tienePermiso('Editar Noticia', $usuario_id)) {
                            echo '<li class="nav-item" id="Adminxd">
                                    <a class="nav-link" href="../Vistas/editarNoticia.php">Editar Noticia</a>
                                </li>';
                        }
                        ?>
                        <?php
                        if (Permisos::tienePermiso('Editar Noticia', $usuario_id)) {
                                echo '<li class="nav-item" id="Adminxd">
                                        <a class="nav-link" href="../Vistas/editarVistaPrevia.php">Editar Vista Previa de Noticias</a>
                                    </li>';
                            }
                        ?>
                    </ul>
                    
                </div>
                <div class="text-center" style="text-align: rigth;">
                <?php
                        if (isset($_SESSION['usuario'])) {
                            // Usuario ha iniciado sesión, muestra el botón "Cerrar Sesión"
                            echo '<button type="button" class="btn btn-danger ml-auto" id="logout" ><a class="linkBoton" href="../controlador/cerrarSesion.php">Cerrar Sesión</a></button>';
                            echo '<div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="usermenu" data-bs-toggle="dropdown" aria-expanded="false">
                                        Perfil
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="usermenu">
                                        <li><a class="dropdown-item" href="VerPerfil.php">Ver Perfil</a></li>
                                        <li><a class="dropdown-item" href="EditarPerfil.php">Editar Perfil</a></li>
                                    </ul>
                                </div>';
                        } else {
                            // Usuario no ha iniciado sesión, muestra los botones "Iniciar Sesión" y "Registrarse"
                            echo '
                            <div class="d-lg-none d-xl-none">
                                <!-- Estos botones solo se muestran en pantallas pequeñas -->
                                <button type="button" class="btn btn-secondary me-2 ml-auto" id="registerPequeño" data-bs-toggle="modal" data-bs-target="#myRegister">Registrarse
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-primary ml-auto" id="login" data-bs-toggle="modal" data-bs-target="#myModal">Iniciar Sesión
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                    </svg>
                                </button>
                            </div>';

                            echo '
                            <!-- Estos botones se muestran en pantallas medianas y grandes -->
                            <div class="d-none d-lg-block d-xl-block  ml-auto">
                                <button type="button" class="btn btn-secondary me-2" id="registerGrande" data-bs-toggle="modal" data-bs-target="#myRegister" >Registrarse
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                                    </svg>
                                </button>
            
                                <button type ="button" class="btn btn-primary ml-auto" id="login" data-bs-toggle="modal" data-bs-target="#myModal" >Iniciar Sesión
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                    </svg>
                                </button>
                            </div>
                        ';
                        }
                    ?>
                </div>
            </div>
        </nav>
    </div>

    <!--MODALES PARA REGISTRO E INICIO DE SESION -->

    <div class="modal fade" id="myRegister" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                  <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Registrar Usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                  <!-- Modal body -->
                <form action="../controlador/registrarUser.php" method="post" id="registrarUsuario">
                  <div class="modal-body">
                        <label for="name_registro">Ingresar Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="name_registro" name="name_registro" required placeholder="Ingresar nombre">
                        <div class="invalid-feedback">Nombre inválido. Utilice un formato válido (Sin espacios y solo letras).</div>
                    </div>
    
                    <div class="modal-body">
                        <label for="email_registro">Ingresar Correo:</label>
                        <input type="email" class="form-control" id="email_registro" name='email_registro' required placeholder="Ingresar email">
                        <div class="invalid-feedback">Correo inválido. Utilice un formato válido.</div>
                    </div>
    
                    <div class="modal-body">
                        <label for="passwordRegistro">Contraseña:</label>
                        <input type="password" required class="form-control" id="passwordRegistro" name="passwordRegistro" required placeholder="Contraseña">
                    </div>
    
                    <div class="modal-body">
                        <label for="fecha_Registro">Fecha de Nacimiento:</label>
                        <input type="date" required class="form-control" id="fecha_Registro" name="fecha_Registro">
                        <div class="invalid-feedback">Fecha de nacimiento inválida.</div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="registrarme" name="registrarme">Registrarme</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                  <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Iniciar Sesion</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                  <!-- Modal body -->
                <form action="../controlador/iniciarSesionUsuario.php" method="post">
                        <div class="modal-body">
                            <label for="userName">Ingrese su Nombre de Usuario:</label>
                            <input type="text" class="form-control" id="userName" name="userName" required placeholder="Ingrese su username">
                        </div>
                        <div class="modal-body">
                            <label for="correo">Ingresar Correo:</label>
                            <input type="correo" class="form-control" id="correo" required placeholder="Ingresar email" name="correo">
                        </div>

                        <div class="modal-body">
                            <label for="contraseña">Contraseña:</label>
                            <input type="password" required class="form-control" id="contraseña" placeholder="contraseña" name="contraseña">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="botonenviar">Enviar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
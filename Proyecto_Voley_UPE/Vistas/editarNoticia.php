<?php
require_once("../Modelo/Usuario.php");
require_once("../Controlador/Permisos.php");
session_start();
$usuarioID = $_SESSION['id']; //

if (!Permisos::esRol('administradorContenido', $usuarioID)) {
    // 
    echo "Debes ser administrador de contenido para editar las noticias.";
    exit();
}

if (!Permisos::tienePermiso('Editar Noticia', $usuarioID)) {
    echo "Debes tener permiso para editar contenido.";
    exit();
}

function obtenerOpciones($tabla) //Para trabajar con esta funcion, recibo el parametro del nombre de la tabla
{

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $port = 3306;
    $db = "bbdd_volleyup";

    try {
        $conexion = new \PDO("mysql:host=$servername;port=$port;dbname=" . $db . ";charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch (Exception $e) {
        echo "Connection failed: " . $e->getMessage();
        die(); // exit;
    }

    $consultSQL = "SELECT id, titulo FROM $tabla"; // consulta para traer el id y el nombre de la tabla
    try{

        $stmt = $conexion->prepare($consultSQL);  //preparo la consulta
        $stmt->execute();               //ejecuto
        $opciones = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $opciones;    //Retorno los datos que encontré para que estos sean usados en el campo select
    }catch (PDOException $e){
        echo "Error de consulta: ". $e->getMessage();
        return []; 
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Voley UPE</title>
    <script defer src="../Vistas/script.js"></script>
    <link rel="stylesheet" href="../Vistas/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></head>
<body>

    <div id="fondo"></div>
        <!-- Incluyo la barra de navegación utilizando JavaScript -->
    <div id="navbar-container" style="padding-bottom: 5%;"></div>
    
    <div class="container-fluid p-5 bg-primary text-white text-center" style="padding-top: 10%;">
        <h1>Formulario Para Actualizar NOTICIA</h1>
        <p>Seleccione la noticia para editarla</p> 
    </div>
    <div class="container text-center">
    <form action="../Controlador/edicionNoticia.php" class="text-black" method="POST" style="padding-top: 5%">


        <div class="mb-3 mb-3 ">
                    <label for="idNoticia">Seleccione la noticia a editar:</label>
                    <select id="idNoticia" name="idNoticia" class="form-control">
                    <option value=""></option>

                    <?php
                    //La variable almacena los datos que retorne despues de ejecturar la consulta
                    $opcionesNoticias = obtenerOpciones("noticias");//Acá obtengo las opciones de la tabla especialidades para el campo select 
                                                                    //Le paso como parametro a la funcion el nombre de la tabla
                    foreach ($opcionesNoticias as $opcion) {
                        echo "<option value='{$opcion['id']}'>{$opcion['titulo']}</option>";  //Imprimo en la pagina las opciones con el id que obtuve de la tabla junto con el nomber
                    }
                    ?>
                </select>
        </div>

        <div class="mb-3">
            <label for="nuevo_titulo" >Nuevo Título:</label>
            <input type="text" class="form-control" id="nuevo_titulo" name="nuevo_titulo" value="">
        </div>
        <div class="mb-3 ">
            <label for="nuevo_texto" >Nueva Descripcion de la Noticia:</label>
            <textarea class="form-control" id="nuevo_texto" name="nuevo_texto"></textarea>
        </div>
        <div class="mb-3 ">
                <label for="pathFoto">Seleccionar Foto:</label>
                <input type="file" class="form-control-file" name="PathFoto1" accept="image/*" required>
        </div>
        <div class="mb-3 ">
                <label for="pathFoto">Seleccionar Foto 2:</label>
                <input type="file" class="form-control-file" name="PathFoto2" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
    </div>    

    <footer style="padding-top: 10%">
    <div id="footer-container"></div>
    </footer>
</body>
</html>
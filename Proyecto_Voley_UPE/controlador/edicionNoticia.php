<?php
require_once("../Modelo/Usuario.php");
require_once("../Controlador/Permisos.php");
require_once("../Modelo/Noticia.php");



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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNoticia = isset($_POST['idNoticia']) ? $_POST['idNoticia'] : null;
    $nuevoTitulo = isset($_POST['nuevo_titulo']) ? $_POST['nuevo_titulo'] : null;
    $nuevaDescripcion = isset($_POST['nuevo_texto']) ? $_POST['nuevo_texto'] : null;
    $nuevaFoto1 = isset($_POST['PathFoto1']) ? $_POST['PathFoto1'] : null;
    $nuevaFoto2 = isset($_POST['PathFoto2']) ? $_POST['PathFoto2'] : null;



    if (empty($idNoticia) || empty($nuevoTitulo) || empty($nuevaDescripcion)) {
        echo "Debes completar todos los campos para actualizar la noticia.";
    } else {
        $noticia = new Noticia($idNoticia, $nuevoTitulo, $nuevaDescripcion, $nuevaFoto1, $nuevaFoto2, '');

        $noticia->actualizarNoticia();

        header("Location: ../vistas/noticiasgeneral.php");

        /* Funcionalidad para redirigir dinamicamente a la noticia que se actualizó
        
        $sql = "SELECT N.idNoticiaPrincipal FROM noticias AS N INNER JOIN noticiasprincipales AS NP ON N.idNoticiaPrincipal = NP.id";
         $stmt = $conexion->query($sql);
    
        if ($stmt) {
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($resultado) {
                $idNoticiaEspecifica = $resultado['idNoticiaPrincipal'];
                header("Location: ../vistas/NoticiaEspecifica.php?id={$idNoticiaEspecifica}");
            } else {
                echo "No se encontró ninguna noticia específica.";
            }
        }*/

    }
}
?>

<?php
include_once ('../Modelo/Jugador.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    
    $jugador = new Jugador("", "","","","","","");

   $resultado = $jugador->eliminarNombreYApellido($nombre, $apellido);
   if($resultado == true)
   {
    header('Location: ../Vistas/controlAdmin.php');
    exit();
   }
}
// ctrol z s
?>

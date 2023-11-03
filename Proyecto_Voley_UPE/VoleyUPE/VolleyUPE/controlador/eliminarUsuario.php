<?php
include_once ('../Modelo/Usuario.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $correo = $_POST["email"];
    
    $usuario = new Usuario("", "","","");

   $resultado = $usuario->eliminarPorCorreo($correo);
   if($resultado == true)
   {
    header('Location: ../Vistas/controlAdmin.php');
    exit();
   }
}
// ctrol z s
?>

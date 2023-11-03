<?php
include_once ('../Modelo/Usuario.php');

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $correo = $_POST["email"];
    $password = $_POST["contraseña"];
    $fecha_edad = $_POST["fecha_edad"];
    $perfil = $_POST["id_perfil"];
    
    $usuario = new Usuario($correo, $password,$fecha_edad,$perfil);

   $resultado = $usuario->registrar();
   if($resultado == true)
   {
    header('Location: ../Vistas/controlAdmin.php');
    exit();
   }

}


?>
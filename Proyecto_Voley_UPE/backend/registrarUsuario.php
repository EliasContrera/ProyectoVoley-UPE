
<?php
include_once ('clases/Usuario.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $correo = $_POST["email"];
    $password = $_POST["passwordRegistro"];
    $fecha_edad = $_POST["fecha_edad"];
    $perfil = 3;
    
    $usuario = new Usuario($correo, $password,$fecha_edad, $perfil);

   $resultado = $usuario->registrar();
   if($resultado == true)
   {
    header('Location: ../frontend/index.html');
    exit();
   }
}
?>



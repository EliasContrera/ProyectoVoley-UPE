<?php
include_once ('../Modelo/equipo.php');

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $nombre = $_POST["nombre"];

    echo "Nombre: " . $nombre . "<br>";
    
    $equipo = new equipo($nombre,0,1);

   $resultado = $equipo->registrar();
   if($resultado == true)
   {
    header('Location: ../Vistas/controlAdmin.php');
    exit();
   }
   else
   {
    echo "Error en la carga";
   }

}

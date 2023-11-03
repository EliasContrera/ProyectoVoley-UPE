<?php
include_once ('../Modelo/Jugador.php');

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $edad = $_POST["edad"];
    $altura = $_POST["altura"];
    $id_posicion = $_POST["id_posicion"];
    $id_equipo = $_POST["id_equipo"]; // es un numero
    $pathFoto = $_POST["pathFoto"];

    echo "Nombre: " . $nombre . "<br>";
    echo "Apellido: " . $apellido . "<br>";
    echo "Edad: " . $edad . "<br>";
    echo "Altura: " . $altura . "<br>";
    echo "ID de Posición: " . $id_posicion . "<br>";
    echo "ID de Equipo: " . $id_equipo . "<br>";
    echo "Ruta de la Foto: " . $pathFoto . "<br>";

    $jugador = new Jugador($nombre, $apellido,$edad,$altura,$id_posicion,$id_equipo,$pathFoto);

   $resultado = $jugador->registrar();
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


?>
<?php
include_once ('../Modelo/Jugador.php');

if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $edad = $_POST["edad"];
        $id_equipo = $_POST["id_equipo"]; 
        
        $jugador = new Jugador("", "","","","","","");

        $jugadorEncontrado= new Jugador("", "","","","","","");
        $jugadorEncontrado= $jugador->buscar($nombre,$apellido,$edad,$id_equipo);
        if($jugadorEncontrado != null)
        {
            session_start();
            $_SESSION['jugadorEncontrado'] = $jugadorEncontrado;
           header('Location:../Vistas/jugadorEncontrado.php');
           exit();
        }
        else
        {
            echo "Error en alguno de los campos";
        };

    }


?>
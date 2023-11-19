<?php
    include_once ('../Modelo/partido.php');
    include_once ('../Modelo/ubicacion.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      
        $fechaRecibida = $_POST["fecha"];
        $puntosGanador = $_POST["puntosGanador"];
        $puntosPerdedor = $_POST["puntosPerdedor"];
        $equipo1Recibido = $_POST["equipo1"];
        $equipo2Recibido = $_POST["equipo2"];
        $equipoGanador= $_POST["equipoGanador"];
        $equipoPerdedor= $_POST["equipoPerdedor"];
        $ubicacionRecibida= $_POST["ubicacion"];
        $pathFoto = $_POST["pathFoto"];
    
    
        $partidoNuevo = new partido("$equipo1Recibido","$equipo2Recibido","$fechaRecibida","$equipoGanador","$equipoPerdedor","$puntosGanador","$puntosPerdedor","$ubicacionRecibida","$pathFoto");
    
       $resultado = $partidoNuevo->agregar();
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
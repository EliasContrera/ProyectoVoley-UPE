<?php
class partido
{
    private $fecha;
    private $puntosGanador;
    private $puntosPerdedor;
    private $equipo1;
    private $equipo2;
    private $ganador;
    private $perdedor;
    private $ubicacion;
    private $pathFoto;
    private $conexion;
    
    public function __construct($equipo1,$equipo2,$fecha,$ganador,$perdedor, $puntosGanador,$puntosPerdedor,$ubicacion, $pathFoto)
    {
        $this->equipo1 = $equipo1;
        $this->equipo2 = $equipo2;
        $this->fecha = $fecha;
        $this->ganador = $ganador;
        $this->perdedor = $perdedor;
        $this->puntosGanador = $puntosGanador;
        $this->puntosPerdedor = $puntosPerdedor;
        $this->ubicacion = $ubicacion;
        $this->pathFoto = $pathFoto;

        // nombreservidor, nombreUsuario, contraseña, nombreDeLaBBDD.
        $this->conexion = new mysqli("localhost","root","","bbdd_volleyup");

        if($this->conexion->connect_error)
        {
            die("error en la conexion de base de datos ".$this->conexion->connect_error);
        }

    }

    public function Agregar()
    {
        $sql = "INSERT INTO partido(id_equipo1,id_equipo2,fecha,id_ganador,id_perdedor,puntos_ganador,puntos_perdedor,id_ubicacion, pathFoto) VALUES('$this->equipo1','$this->equipo2','$this->fecha','$this->ganador','$this->perdedor','$this->puntosGanador','$this->puntosPerdedor','$this->ubicacion', '$this->pathFoto')";
        if($this->conexion->query($sql))
        {
         return true;
        }
        else
        {
         echo "error en el query";
         return false;
        }
        
    }

}
?>
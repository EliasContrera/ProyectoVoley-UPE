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
    private $conexion;
    
    public function __construct($fecha, $puntosGanador,$puntosPerdedor,$equipo1,$equipo2,$ganador,$perdedor,$ubicacion)
    {
        $this->fecha = $fecha;
        $this->puntosGanador = $puntosGanador;
        $this->puntosPerdedor = $puntosPerdedor;
        $this->equipo1 = $equipo1;
        $this->equipo2 = $equipo2;
        $this->ganador = $ganador;
        $this->perdedor = $perdedor;
        $this->ubicacion = $ubicacion;

        // nombreservidor, nombreUsuario, contraseña, nombreDeLaBBDD.
        $this->conexion = new mysqli("localhost","root","","bbdd_volleyup");

        if($this->conexion->connect_error)
        {
            die("error en la conexion de base de datos ".$this->conexion->connect_error);
        }

    }

    public function registrar()
    {
        
    }

}
?>
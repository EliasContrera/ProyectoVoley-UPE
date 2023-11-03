<?php
class equipo
{
    private $nombre;
    private $puntos;
    private $liga;
    private $conexion;
    
    public function __construct($nombre, $puntos,$liga)
    {
        $this->nombre = $nombre;
        $this->puntos = $puntos;
        $this->liga=$liga;
        // nombreservidor, nombreUsuario, contraseña, nombreDeLaBBDD.
        $this->conexion = new mysqli("localhost","root","","bbdd_volleyup");

        if($this->conexion->connect_error)
        {
            die("error en la conexion de base de datos ".$this->conexion->connect_error);
        }

    }

}
?>
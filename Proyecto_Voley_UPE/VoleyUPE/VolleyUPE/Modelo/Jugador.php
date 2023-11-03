<?php
class Jugador
{
    private $nombre;
    private $apellido;
    private $edad;
    private $altura;
    private $id_posicion;
    private $id_equipo;
    private $pathFoto;
    private $conexion;
    public function __construct($nombre, $apellido,$edad,$altura, $id_posicion, $id_equipo,$pathFoto)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->altura = $altura;
        $this->id_posicion = $id_posicion;
        $this->id_equipo = $id_equipo;
        $this->pathFoto = $pathFoto;
        // nombreservidor, nombreUsuario, contraseña, nombreDeLaBBDD.
        $this->conexion = new mysqli("localhost","root","","bbdd_volleyup");

        if($this->conexion->connect_error)
        {
            die("error en la conexion de base de datos ".$this->conexion->connect_error);
        }

    }

    public function registrar()
    {
        $sql = "INSERT INTO jugador(nombre,apellido,edad,altura,id_posicion,id_equipo,pathFoto) VALUES('$this->nombre','$this->apellido','$this->edad','$this->altura','$this->id_posicion','$this->id_equipo','$this->pathFoto')";
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

    public function eliminarNombreYApellido($nombreJugador, $apellidoJugador)
    {
        $sql = "DELETE FROM jugador WHERE nombre = '$nombreJugador' AND apellido = '$apellidoJugador'";
        return $this->conexion->query($sql);
    }
}

?>
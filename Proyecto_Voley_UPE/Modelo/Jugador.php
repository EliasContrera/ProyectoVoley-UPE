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

    public function buscar($nombreJugador, $apellidoJugador, $edadJugador,$idequipo){
        $sql = "SELECT * FROM jugador WHERE nombre='$nombreJugador' AND apellido='$apellidoJugador' AND edad='$edadJugador' AND id_equipo='$idequipo'";
        $resultado = $this->conexion->query($sql);
        if ($resultado->num_rows > 0) {
            // Si se encontró  crear un objeto de tipo JUGADOR y retornarlo
            $fila = $resultado->fetch_assoc();
            $jugador = new Jugador("","","","","","","");
            $jugador->nombre= $fila["nombre"];
            $jugador->apellido= $fila["apellido"];
            $jugador->edad= $fila["edad"];
            $jugador->id_equipo = $fila["id_equipo"];
            $jugador->altura=$fila["altura"];
            $jugador->id_posicion=$fila["id_posicion"];
            $jugador->pathFoto=$fila["pathFoto"];
            return $jugador;
        }
    }
    public function editarJugador($nombreJugador, $apellidoJugador, $edadJugador,$idequipo)
    {
        $sql = "UPDATE `jugador` SET `nombre`='[$this->nombre]',`apellido`='[$this->apellido]',`edad`='[$this->edad]',`altura`='[$this->altura]',`pathFoto`='[$this->pathFoto]',`id_equipo`='[$this->id_equipo]',`id_posicion`='[$this->id_posicion]' WHERE nombre='$nombreJugador' AND apellido='$apellidoJugador' AND edad='$edadJugador' AND id_equipo='$idequipo'";
        return $this->conexion->query($sql);
    }

    public function recuperarTodosLosJugadores()
    {
        $sql = "SELECT * FROM jugador";

        $resultado = $this->conexion->query("SELECT * FROM jugador");


            $jugadores = array();
            while($fila = $resultado->fetch_assoc()) {
                $jugadores[] = $fila;
            echo json_encode($jugadores);


}

// Devolver los datos en formato JSON
echo json_encode($jugadores);
    }

    public function getnombre()
    {
        return $this->nombre;
       
    }

    public function getapellido()
    {
        return $this->apellido;
    }

    public function getedad()
    {
        return $this->edad;
    }

    public function getaltura()
    {
        return $this->altura;
    }
    public function getposicion()
    {
        return $this->id_posicion;
    }
    public function getequipo()
    {
        return $this->id_equipo;
    }

    public function getfoto()
    {
        return $this->pathFoto;
    }
}

?>
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

    
    public function registrar()
    {
        $sql = "INSERT INTO equipo(nombre, puntos, id_liga) VALUES('$this->nombre','0','1')";
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

    public function recuperarTodosLosEquipos()
    {
        $sql = "SELECT * FROM equipo";

        $resultado = $this->conexion->query("SELECT * FROM equipo");

        if (isset($_GET['accion'])) {
            $accion = $_GET['accion'];
            if ($accion === 'recuperarTodosLosEquipos') {
                $equipos = array();
            while($fila = $resultado->fetch_assoc()) {
                $equipos[] = $fila;
            echo json_encode($equipos);
            }
            }

           
    }



}
}
?>
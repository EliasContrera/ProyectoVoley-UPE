<?php

class Usuario
{
    private $nombre;
    private $correo;
    private $password;
    private $fechaNacimiento;
    private $conexion;

    public function __construct($correo, $password, $fechaNacimiento, $nombre)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->password = $password;
        $this->fechaNacimiento = $fechaNacimiento;
        
        // Establece la conexión a la base de datos en el constructor
        $this->conexion = new mysqli("localhost", "root", "", "bbdd_volleyup");

        if ($this->conexion->connect_error) {
            die("Error en la conexión de base de datos: " . $this->conexion->connect_error);
        }
    }

    public function registrar()
    {
        // Validar que el correo no esté en uso
        if ($this->verificarCorreoExistente($this->correo)) {
            return "El correo ya está en uso.";
        }
    
        $sql = "INSERT INTO usuario (fecha_nacimiento, nombre, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
    
        // Verifica que la consulta preparada se haya creado con éxito
        if ($stmt) {
            $stmt->bind_param("ssss", $this->nombre, $this->correo, $this->password, $this->fechaNacimiento);
    
            if ($stmt->execute()) {
                header('Location: ../Vistas/index.html');

                return "Se ha registrado un nuevo usuario con éxito";
            } else {
                return "Error al registrar el usuario";
            }
        } else {
            return "Error en la consulta SQL";
        }
    }

    private function verificarCorreoExistente($correo)
    {
        $sql = "SELECT COUNT(*) as total FROM usuario WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $stmt->bind_result($total);
            $stmt->fetch();

            // Si el total es mayor a 0, significa que el correo ingresado ya existe
            return $total > 0;
        } else {
            return false;
        }
    }



    public function consultar($nombre, $correo, $password) // Método para iniciar sesión
    {
        $sql = "SELECT id, nombre, email FROM usuario WHERE nombre = '$nombre' AND email = '$correo' AND password = '$password'";
        $resultado = $this->conexion->query($sql);
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            return $usuario;
        } else {
            header("Location: ../Vistas/index.html");
            return null;
        }
    }
    

        ////////////
        /////////////
    
    
        public function actualizarNoticia($idNoticia, $titulo, $descripcion)
        {
            try {
                $query = "UPDATE noticia SET titulo = ?, descripcion = ? WHERE id = ?"; //utilizo los "?" porque voy a trabajar con consultas preparadas (mejora la seguridad)
                $stmt = $this->conexion->prepare($query);   
                $stmt->bind_param("ssi", $titulo, $descripcion, $idNoticia); // "ssi" indica que son dos string y un entero
                                            //enlazo los valores a la consulta stmt, indicando que son 2 string(titulo y descripcion) y 1 entero (id)
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        ///////////
        public function eliminarPorCorreo($correoUsuario) {
            $sql = "DELETE FROM usuario WHERE correo = '$correoUsuario'";
            return $this->conexion->query($sql);
        }

        public function buscarusuario($correo){
            $sql = "SELECT  correo, fecha_nacimiento FROM usuario WHERE correo='$correo'";
            return $this->conexion->query($sql);
        }
}


?>
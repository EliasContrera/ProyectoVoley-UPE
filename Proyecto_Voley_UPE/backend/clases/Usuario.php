<?php

class Usuario
{
    private $correo;
    private $password;
    private $fechaNacimiento;
    private $perfil;
    private $conexion;
    
    public function __construct($correo, $password,$fechaNacimiento,$perfil)
    {
        $this->perfil = $perfil;
        $this->correo = $correo;
        $this->password = $password;
        $this->fechaNacimiento = $fechaNacimiento;
        // nombreservidor, nombreUsuario, contraseña, nombreDeLaBBDD.
        $this->conexion = new mysqli("localhost","root","","bbdd_voleyup");

        if($this->conexion->connect_error)
        {
            die("error en la conexion de base de datos ".$this->conexion->connect_error);
        }

    }
    public function registrar()
    {
       $sql = "INSERT INTO usuario(correo,password,fecha_nacimiento, id_perfil) VALUES('$this->correo','$this->password','$this->fechaNacimiento','$this->perfil')";
       if($this->conexion->query($sql))
       {
        return true;
       }
       else
       {
        return false;
       }
    }

    public function consultar($correo, $password)
    {
        $sql = "SELECT * FROM usuario WHERE correo = '$correo' AND password = '$password'";
        $resultado = $this->conexion->query($sql);
    
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            return $usuario;
        } else {
            return null;
        }
    }
    

    public function validarRolUsuario() {
    
        // Verifica si el usuario ha iniciado sesión
        if (isset($_SESSION['usuario'])) {
    
            // Obtiene el correo del usuario desde la sesión
            $correo = $_SESSION['usuario'];
    
            // Realiza una consulta para obtener el ID_PERFIL del usuario
            $consulta = "SELECT ID_PERFIL FROM USUARIO WHERE CORREO = '$correo'";
            $resultado = $this->conexion->query($consulta);

    
            // Verifica si se encontraron resultados
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $idPerfil = $fila['ID_PERFIL'];
    
                // Verifica si el usuario es un administrador (ID_PERFIL = 1)
                if ($idPerfil == 1) {
                    // El usuario es un administrador, puedes realizar acciones específicas para administradores aquí
                    $rolPerfil = "administrador";
                    echo 'Administrador';
                } else {
                    // El usuario no es un administrador
                    $rolPerfil = "usuario";
                    echo 'Usuario';
                }
                // Cierra la conexión a la base de datos    
                return $rolPerfil;
            } else {
                // No se encontró el usuario en la base de datos
                return 'usuario_no_encontrado';
            }
        } else {
            // Usuario no ha iniciado sesión
            return 'usuario_no_autenticado';
        }
    }


        ////////////
        /////////////
    
    
        public function actualizarNoticia($idNoticia, $titulo, $descripcion)
        {
            try {
                $query = "UPDATE noticia SET titulo = ?, descripcion = ? WHERE id = ?";
                $stmt = $this->conexion->prepare($query);
                $stmt->bind_param("ssi", $titulo, $descripcion, $idNoticia); // "ssi" indica que son dos cadenas y un entero
        
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



}


?>
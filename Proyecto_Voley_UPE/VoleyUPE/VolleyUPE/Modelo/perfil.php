<?php
class Perfil
{
    private $conexion;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $port = 3306;
        $db = "bbdd_volleyup";

        try {
            $this->conexion = new \PDO("mysql:host=$servername;port=$port;dbname=" . $db . ";charset=utf8", $username, $password);
            $this->conexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function mostrarPerfil($correo, $password)
    {

        if (isset($_SESSION['correo']) && isset($_SESSION['password'])) {
            $correo = $_SESSION['correo'];
            $password = $_SESSION['password'];
    
            // Resto del código para consultar y mostrar el perfil del usuario
            try {
                $sql = "SELECT * FROM usuario WHERE correo = :correo AND password = :password";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
    
                $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
                return $usuario;
            } catch (PDOException $e) {
                echo "Error en la consulta: " . $e->getMessage();
                return null;
            }
        } else {
            // La sesión no está iniciada o faltan valores en la sesión
            return null;
        }

    }


    

    public function cerrarConexion()
    {
        $this->conexion = null;
    }
}

?>
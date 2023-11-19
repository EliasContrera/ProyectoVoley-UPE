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

        try {
            // Establece la conexión a la base de datos en el constructor
            $this->conexion = new PDO("mysql:host=localhost;dbname=bbdd_volleyup", "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión de base de datos: " . $e->getMessage());
        }
    }


    public function obtenerIdRolUsuario()
    {
        $rolUsuario = "usuario";
        $sql = "SELECT id FROM roles WHERE nombre = :rolUsuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':rolUsuario', $rolUsuario);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function registrar()
    {
        // Validar que el correo no esté en uso
        if ($this->verificarCorreoExistente($this->correo)) {
            return "El correo ya está en uso.";
        }

        // Registro del usuario
        $sqlUsuario = "INSERT INTO usuario(fecha_nacimiento, nombre, email, password) VALUES (:fechaNacimiento, :nombre, :correo, :password)";
        $stmtUsuario = $this->conexion->prepare($sqlUsuario);

        if (!$stmtUsuario) {
            return "Error en la consulta SQL de usuario";
        }

        $stmtUsuario->bindParam(':fechaNacimiento', $this->fechaNacimiento, PDO::PARAM_STR);
        $stmtUsuario->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $stmtUsuario->bindParam(':correo', $this->correo, PDO::PARAM_STR);
        $stmtUsuario->bindParam(':password', $this->password, PDO::PARAM_STR);

        try {
            $this->conexion->beginTransaction();

            if ($stmtUsuario->execute()) {
                // aca obtengo el ID del usuario recién registrado
                $idUsuario = $this->conexion->lastInsertId();

                // aca obtengo el ID del rol "usuario"
                $idRolUsuario = $this->obtenerIdRolUsuario();

                // asigno automáticamente el rol "usuario" al usuario registrado
                $sqlAsignarRol = "INSERT INTO roles_usuarios(id_usuario, id_rol) VALUES (:idUsuario, :idRolUsuario)";
                $stmtAsignarRol = $this->conexion->prepare($sqlAsignarRol);
                $stmtAsignarRol->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
                $stmtAsignarRol->bindParam(':idRolUsuario', $idRolUsuario, PDO::PARAM_INT);

                if ($stmtAsignarRol->execute()) {
                    $this->conexion->commit();
                    header('Location: ../Vistas/index.php');
                    return "Se ha registrado un nuevo usuario con éxito";
                } else {
                    $this->conexion->rollBack();
                    return "Error al asignar el rol al usuario";
                }
            } else {
                $this->conexion->rollBack();
                return "Error al registrar el usuario";
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            return "Error en la transacción: " . $e->getMessage();
        }
    }

    private function verificarCorreoExistente($correo)
    {
        $sql = "SELECT COUNT(*) as total FROM usuario WHERE email = :correo";
        $stmt = $this->conexion->prepare($sql);

        if ($stmt) {
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $total = $stmt->fetchColumn();

            return $total > 0;
        } else {
            return false;
        }
    }

    public function validaRequerido($nombre, $correo, $fecha_nacimiento)
    {

            // Validar formato de correo electrónico
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return 'El formato del correo electrónico no es válido.';
        }


        // Validar si la fecha de nacimiento es menor de 16 años
        $edadMinima = 16;
        $edadMaxima = 100;
        $fechaActual = new DateTime();
        $fechaNacimiento = new DateTime($fecha_nacimiento);
        $diferencia = $fechaNacimiento->diff($fechaActual);
        $edad = $diferencia->y;

        if ($edad < $edadMinima || $edad > $edadMaxima) {
            return 'Debes ser mayor de 16 años y menor de 100 años para registrarte.';
        }

        // valido que el campo no este vacio
        if (trim($nombre) === '') {
            return 'El campo nombre no puede estar vacío.';
        }

        // divido la cadena del input por cada espacio que encuentre, y lo guardo en la variable palabras
        $palabras = explode(' ', $nombre);

        // Valido que palabras sea distinto de 2, es decir, que no exista mas ni menos de 2 palabras
        if (count($palabras) != 1) {
            return 'El campo nombre debe contener al menos dos palabras. ';
        }

        foreach ($palabras as $palabra) {  //Valido el campo nombre para que las palabras no tengan numeros ni caracteres fuera del abecedario
            if (!preg_match('/^[a-zA-ZáéíóúüÁÉÍÓÚÜ]+$/', $palabra)) {
                return 'Debe contener solo letras y tildes.';
            }

            $longitud = mb_strlen($nombre, 'UTF-8');
            if ($longitud < 4 || $longitud > 60) {  //Valido el rango de caracteres de las palabras, uso entre 4 y 60, es decir, el nombre debe tener almenos 4 caracteres
                return 'Cada palabra debe tener entre 4 y 60 caracteres.';
            }
        }

        // Todas las validaciones pasaron
        return true; //Retorno verdadero porque el formato del campo nombre cumple las validaciones
    }

    public function eliminarPorCorreo($correoUsuario) {
        $sql = "DELETE FROM usuario WHERE correo = '$correoUsuario'";
        return $this->conexion->query($sql);
    }

    public function buscarusuario($correo){
        $sql = "SELECT  email, fecha_nacimiento FROM usuario WHERE email='$correo'";
        return $this->conexion->query($sql);
    }
    //
}
?>
    


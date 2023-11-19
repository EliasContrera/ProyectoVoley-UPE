<?php

class Comentarios
{
    
    private $IDusuario;
    private $IDcomentaro;
    private $description;
    private $NombreUSuario;
    private $conexion;

    public function __construct($IDusuario, $IDcomentaro, $description, $NombreUSuario)
    {
        $this->IDusuario = $IDusuario;
        $this->IDcomentaro = $IDcomentaro;
        $this->description = $description;
        $this->NombreUSuario = $NombreUSuario;
        
        try {
            // Establece la conexión a la base de datos en el constructor
            $this->conexion = new PDO("mysql:host=localhost;dbname=bbdd_volleyup", "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión de base de datos: " . $e->getMessage());
        }
    }

    public function AgregarComentario($UsuarioID, $descripcion)
    {
        try {
            $sql = "INSERT INTO Comentarios (UsuarioID, Descripcion) VALUES (:UsuarioID, :Descripcion)";
            $stmt = $this->conexion->prepare($sql);
    
            if ($stmt) {
                $stmt->bindParam(':UsuarioID', $UsuarioID, PDO::PARAM_INT);
                $stmt->bindParam(':Descripcion', $descripcion, PDO::PARAM_STR);
    
                if ($stmt->execute()) {
                    return "Se ha agregado el comentario con éxito";
                } else {
                    return "Error al agregar el comentario";
                }
            } else {
                return "Error en la consulta SQL";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function MostrarComentarios() // Metodo
    {
        try {
            $sql = "SELECT ID, UsuarioID, Descripcion FROM Comentarios";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();

            $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $comentarios;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
<?php
class Noticia
{
    private $id;
    private $titulo;
    private $descripcion;
    private $pathFoto1;
    private $pathFoto2;
    private $idNoticiaPrincipal;
    private $pdo;
    
    public function __construct($id, $titulo, $descripcion, $pathFoto1, $pathFoto2, $idNoticiaPrincipal)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->pathFoto1 = $pathFoto1;
        $this->pathFoto2 = $pathFoto2;
        $this->idNoticiaPrincipal = $idNoticiaPrincipal;

        // Configura la conexión PDO
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $port = 3306;
        $db = "bbdd_volleyup";

        try {
            $this->pdo = new \PDO("mysql:host=$servername;port=$port;dbname=" . $db . ";charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión de la base de datos: " . $e->getMessage());
        }
    }
    
    public function agregarNoticia()
    {
        $sql = "INSERT INTO noticias (Titulo, Descripcion, PathFoto1, PathFoto2, IdNoticiaPrincipal) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->titulo, $this->descripcion, $this->pathFoto1, $this->pathFoto2, $this->idNoticiaPrincipal]);
    }

    public function actualizarNoticia()
    {
        $sql = "UPDATE noticias SET Titulo = :titulo, Descripcion = :descripcion WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "Noticia actualizada con éxito.";
        } else {
            echo "Error al actualizar la noticia: " . $stmt->errorInfo()[2];
        }
    }

    public function actVistaPreviaNoticias()
    {
        $sql = "UPDATE noticiasprincipales SET Titulo = :titulo, Descripcion = :descripcion WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            header ('Location: ../Vistas/index.html');
            echo "Vista previa de la noticia actualizada con éxito.";
        } else {
            echo "Error al actualizar la noticia: " . $stmt->errorInfo()[2];
        }
    }
    // Agregar métodos para interactuar con noticias en la base de datos usando PDO
    // Por ejemplo, métodos para agregar, actualizar, eliminar noticias, etc.
}
?>
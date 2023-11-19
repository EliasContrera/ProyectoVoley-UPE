<?php
    include_once ('../Modelo/Usuario.php');

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $correo = $_POST["email"];
        
        $usuario = new Usuario("", "","","");
    
       $resultado = $usuario->buscarusuario($correo);

      
       if($resultado == true){
        echo("Usuario encontrado");
        while ($row = $resultado->fetchAll()){
            echo("".$row["email"]."".$row["fecha_nacimiento"]);
        }
        //header('Location: ../Vistas/controlAdmin.php');
        exit();
       }else{
        echo("Usuario no encontrado");
        exit(); 

       };

       /*if($resultado == true)
       {
        header('Location: ../Vistas/controlAdmin.php');
        exit();
       }*/
    }
    // ctrol z s

?>
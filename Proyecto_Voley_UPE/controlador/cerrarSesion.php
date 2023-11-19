<?php
session_start();
session_destroy(); // Cierra la sesión
header('Location: ../Vistas/index.php'); // Redirige a la página de inicio o a donde desees
exit();
?>
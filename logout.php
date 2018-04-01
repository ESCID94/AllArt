<?php
  require_once __DIR__.'/includes/config.php';
  
  // Tenemos que asegurarnos de participar en la sessión actual
  session_start();
  
  // Destruimos la sesión
  session_destroy();
  
  // Redirigimos a la página principal del ejemplo
  header('Location: '.EJEMPLO);
?>
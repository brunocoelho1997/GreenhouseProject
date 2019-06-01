<?php
// iniciar sessуo
session_start();
 
// destruir a sessуo
session_destroy();
 
// enviar o utilizador para pсgina de autenticaчуo
header('Location: ..\index.php');
?>
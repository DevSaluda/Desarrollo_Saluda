<?php
session_start();
setcookie ("IngresoEnfer", "", time() - 3600);
session_unset();
session_destroy();
header("Location:https://controlconsulta.com/App/Secure/Enfermeria2");
?>
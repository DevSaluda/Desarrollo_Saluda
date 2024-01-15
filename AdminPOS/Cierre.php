<?php

session_start();
setcookie ("mostrarModal", "", time() - 3600);
session_unset();
session_destroy();
setcookie('csrf_token', '', time() - 3600, '/');

header("Location:https://saludapos.com/App/Secure/POS");
?>
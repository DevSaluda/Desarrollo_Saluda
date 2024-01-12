
<?php
session_start();
setcookie ("IngresoVentas", "", time() - 3600);
session_unset();
session_destroy();
header("Location:https://controlfarmacia.com/App/Secure/POS2");
?>




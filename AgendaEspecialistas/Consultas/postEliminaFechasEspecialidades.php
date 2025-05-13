<?php
if (!empty($_POST['Id_Fechaeliminar']) ) {
    include_once 'db_connection.php';

    
    $idFechas = $_POST['Id_Fechaeliminar'];
    $success = true;

    foreach ($idFechas as $key => $val) {
      

        $sql = "DELETE FROM  `Fechas_EspecialistasExt` 
                WHERE ID_Fecha_Esp=$val";

        if (!mysqli_query($conn, $sql)) {
            $success = false;
            break; // Detener el bucle si hay un error en alguna de las actualizaciones
        }
    }

    if ($success) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201, "error" => mysqli_error($conn)));
    }

    mysqli_close($conn);
} else {
    echo json_encode(array("statusCode" => 400, "error" => "Datos no válidos"));
}
?>

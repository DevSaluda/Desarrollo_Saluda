<?php
include "db_connection.php";

$Pos_ID = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['user']))));
$Fk_Sucursal = '';

if (isset($_POST['Sucursal'])) {
    $Fk_Sucursal = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
} else {
    // Aquí puedes manejar el caso en que 'Sucursal' no está presente en $_POST
    echo json_encode(array("statusCode" => 400, "message" => "La clave 'Sucursal' no está presente en la solicitud POST."));
    exit(); // Terminar la ejecución del script
}

$sql = "UPDATE `PersonalPOS` 
        SET 
        `Fk_Sucursal`='$Fk_Sucursal' 
        WHERE Pos_ID=$Pos_ID";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
?>

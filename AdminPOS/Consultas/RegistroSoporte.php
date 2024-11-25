<?php
include_once 'db_connection.php';

if (!empty($_POST['Problematica']) || !empty($_FILES['file']['name'])) {
    $uploadedFile = '';

    if (isset($_FILES["file"]["type"])) {
        $fileName = '';
        if (isset($_FILES['file']['name'])) {
            $fileName = time() . '_' . $_FILES['file']['name'];
            $valid_extensions = array("jpeg", "jpg", "png");
            $temporary = explode(".", $_FILES["file"]["name"]);
            $file_extension = end($temporary);

            if (
                (
                    ($_FILES["file"]["type"] == "image/png") ||
                    ($_FILES["file"]["type"] == "image/jpg") ||
                    ($_FILES["file"]["type"] == "image/jpeg") ||
                    ($_FILES["file"]["type"] == "image/png")
                ) && in_array($file_extension, $valid_extensions)
            ) {
                $sourcePath = $_FILES['file']['tmp_name'];
                $targetPath = "../../ImagenesTickets/$fileName";
                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $uploadedFile = $fileName;
                }
            }
        }

        $Problematica = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Problematica']))));
        $DescripcionProblematica = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['DescripcionProblematica']))));
        $Fecha = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Fecha']))));
        $Sucursal = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Sucursal']))));
        $Agregado_Por = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Agregado_Por']))));
        $ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['ID_H_O_D']))));

        // Consulta para comprobar si ya existe un registro con los mismos valores
        $sql = "SELECT Problematica, Fecha, Sucursal FROM Tickets_Soporte WHERE Problematica='$Problematica' AND 
            Fecha='$Fecha' AND Sucursal='$Sucursal'";
        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
        $row = mysqli_fetch_assoc($resultset);

        if ($row && $row['Problematica'] == $Problematica && $row['Fecha'] == $Fecha && $row['Sucursal'] == $Sucursal) {
            echo json_encode(array("statusCode" => 250));
        } else {
            $sql = "INSERT INTO `Tickets_Soporte`(`Problematica`, `DescripcionProblematica`, `Fecha`, `Sucursal`, `Agregado_Por`, `ID_H_O_D`, `file_name`) 
                VALUES ('$Problematica', '$DescripcionProblematica', '$Fecha', '$Sucursal', '$Agregado_Por', '$ID_H_O_D', '$uploadedFile')";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode" => 200));
            } else {
                echo json_encode(array("statusCode" => 201));
            }

            mysqli_close($conn);
        }
    }
}
?>

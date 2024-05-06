<?php
include_once 'db_connection.php';
var_dump($_POST);

$Nombre_Promo = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['NombrePromo']))));
$CantidadADescontar = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['CantidadDesc']))));
$Fk_Tratamiento = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Tratamiento']))));
$Estatus = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['VigenciaEstPromo']))));
$CodigoEstatus = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['VigenciaPromo']))));
$Agrega = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['UsuarioPromo']))));
$Sistema = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['SistemaPromo']))));
$ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['EmpresaPromo']))));

// Consulta para verificar si ya existe una promoción con el mismo nombre y tratamiento en la empresa especificada.
$sql = "SELECT 1 FROM Promos_Credit_POS 
        WHERE Nombre_Promo = '$Nombre_Promo' 
        AND Fk_Tratamiento = '$Fk_Tratamiento' 
        AND ID_H_O_D = '$ID_H_O_D'";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

if (mysqli_num_rows($resultset) > 0) {
    // Mensaje de error si esa promocion ya existe
    echo json_encode(array("statusCode" => 250, "message" => "Ya existe una promocion con el mismo nombre."));
} else {
    // Inserta la nueva promocion si no estaba añadida
    $insertSql = "INSERT INTO `Promos_Credit_POS`(`Nombre_Promo`, `CantidadADescontar`, `Fk_Tratamiento`, `Estatus`, `CodigoEstatus`, `Agrega`, `Sistema`, `ID_H_O_D`) 
                  VALUES ('$Nombre_Promo', '$CantidadADescontar', '$Fk_Tratamiento', '$Estatus', '$CodigoEstatus', '$Agrega', '$Sistema', '$ID_H_O_D')";

    if (mysqli_query($conn, $insertSql)) {
        echo json_encode(array("statusCode" => 200, "message" => "Promotion added successfully."));
    } else {
        echo json_encode(array("statusCode" => 201, "message" => "Failed to add promotion."));
    }
}

$(document).ready(function() {
    $('#AgregaPromoCreditos').on('submit', function(e) {
        e.preventDefault(); // Previene el envío normal del formulario
        var formData = $(this).serialize(); // Serializa los datos del formulario
        console.log(formData); // Imprime los datos en la consola para verificar

        // Aquí iría el código para enviar los datos mediante AJAX si así lo deseas
    });
});

mysqli_close($conn);
?>

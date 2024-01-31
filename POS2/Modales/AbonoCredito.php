<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/ConsultaCaja.php";
include "../Consultas/SumadeFolioTickets.php";
$fcha = date("Y-m-d");
$user_id = null;

// Usando consulta preparada para evitar problemas de seguridad
$sql1 = "SELECT Creditos_POS.Folio_Credito, Creditos_POS.Fk_tipo_Credi, Creditos_POS.Nombre_Cred, Creditos_POS.Cant_Apertura, Creditos_POS.Fk_Sucursal, Creditos_POS.Validez, Creditos_POS.Saldo,
    Creditos_POS.Estatus, Creditos_POS.CodigoEstatus, Creditos_POS.ID_H_O_D, Tipos_Credit_POS.ID_Tip_Cred,
    Tipos_Credit_POS.Nombre_Tip, SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal 
    FROM Creditos_POS, Tipos_Credit_POS, SucursalesCorre 
    WHERE Creditos_POS.Fk_tipo_Credi=Tipos_Credit_POS.ID_Tip_Cred 
    AND Creditos_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
    AND Creditos_POS.ID_H_O_D = ?
    AND Creditos_POS.Folio_Credito = ?";

$stmt = $conn->prepare($sql1);
$stmt->bind_param("ss", $row['ID_H_O_D'], $_POST["id"]);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($r = $result->fetch_object()) {
            $Especialistas = $r;
            break;
        }
    } else {
        // No se encontraron resultados
        echo "No se encontraron resultados para el ID " . $_POST["id"];
    }

    $stmt->close();
} else {
    // Error en la ejecución de la consulta preparada
    echo "Error en la ejecución de la consulta preparada: " . $stmt->error;
}


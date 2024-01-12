<?php
include_once 'db_connection.php';
$EstadoTraspaso="Con problemas o detalles";
$ID_Traspaso_Generado=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['IDTraspaso']))));
$FK_Producto =$conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['IDProductos']))));
$Cod_Barrra =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['CodBarra']))));
$Cantidad_Enviada =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['CantidadEnviada']))));
$Cantidad_Recibida =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['CantidadRecibida']))));
$Sucursal_Origen =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['OrigenSucursal']))));
$Sucursal_Destino =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['DestinoSucursal']))));
$Fk_SucDestino=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalTrigger']))));
$Estado=  $conn->real_escape_string(htmlentities(strip_tags(Trim($EstadoTraspaso))));
$Comentario =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['ComentariosObservaciones']))));
$Sistema =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
$Registro =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Agrego']))));


    $sql = "INSERT INTO `Registro_Traspasos`( `ID_Traspaso_Generado`,`FK_Producto` ,`Cod_Barrra`, `Cantidad_Enviada`, `Cantidad_Recibida`, `Sucursal_Origen`, `Sucursal_Destino`,`Fk_SucDestino`,
    `Estado`, `Comentario`, `Sistema`, `Registro`) 
            VALUES ( '$ID_Traspaso_Generado', '$FK_Producto','$Cod_Barrra', '$Cantidad_Enviada', '$Cantidad_Recibida', '$Sucursal_Origen', '$Sucursal_Destino', '$Fk_SucDestino',
    '$Estado', '$Comentario', '$Sistema', '$Registro')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);


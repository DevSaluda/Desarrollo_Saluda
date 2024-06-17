
<?php
include "db_connection.php";
                
        $Cod_Barra=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodBarraActualiza']))));
       $Fecha_Caducidad= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaDeCaducidad']))));
        $Lote= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NumDelote']))));
        $Fk_sucursal= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalActualizadora']))));
        $ActualizoFecha= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Fechadeactualizacion']))));
        $Fecha_Ingreso= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Fechadeactualizacion']))));
        
       
        $sql = "UPDATE `Stock_POS` 
        SET `Fecha_Caducidad`='$Fecha_Caducidad',
        `Lote`='$Lote',
        `ActualizoFecha`='$ActualizoFecha',
        `Fecha_Ingreso`='$Fecha_Ingreso'
        WHERE Cod_Barra='$Cod_Barra' AND Fk_sucursal=$Fk_sucursal";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>
<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    include ("db_connection.php");
    include "Consultas.php";
    include "Sesion.php";
    
	
$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($conn)
{
    $fetch = mysqli_query($conn,"SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.ID_Prod_POS,Stock_POS.Clave_adicional,Stock_POS.Cod_Barra,Stock_POS.Nombre_Prod,Stock_POS.Tipo_Servicio,
Stock_POS.Fk_sucursal, Stock_POS.Existencias_R,Stock_POS.Proveedor1,Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Lote,Stock_POS.Precio_C,	Stock_POS.Precio_Venta,
Stock_POS.Estatus,Stock_POS.Fecha_Caducidad,Stock_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Stock_POS,SucursalesCorre WHERE Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND  Fk_sucursal=21 AND Cod_Barra like '%" . mysqli_real_escape_string($conn,($_GET['term'])) . "%' OR Nombre_Prod like '%" . mysqli_real_escape_string($conn,($_GET['term'])) . "%'   LIMIT 1"); 
    /* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
        $ID_Prod_POS=$row['ID_Prod_POS'];
        $Cod_Barra=$row['Cod_Barra'];
        $Nombre_Prod=$row['Nombre_Prod'];
        $Precio_Venta=$row['Precio_Venta'];
      $Precio_Compra=$row['Precio_C'];
      $Tipo_Servicio=$row['Tipo_Servicio'];
      $Proveedor1=$row['Proveedor1'];
      $Proveedor2=$row['Proveedor2'];

        // AQUI VAN LOS ID DE LOS INPUTS
        $row_array['value'] = $row['Cod_Barra']." | ".$row['Nombre_Prod'];
        
        $row_array['idprod']=$row['ID_Prod_POS'];
            $row_array['codbarra']=$row['Cod_Barra'];
            $row_array['nombres']=$row['Nombre_Prod'];
            $row_array['precioventa']=$row['Precio_Venta'];
            $row_array['preciodecompra']=$row['Precio_C'];
            $row_array['tipodeservicio']=$row['Tipo_Servicio'];
            $row_array['proveedor1']=$row['Proveedor1'];
            $row_array['proveedor2']=$row['Proveedor2'];
            $row_array['proveedor1vista1']=$row['Proveedor1'];
            $row_array['proveedor2vista2']=$row['Proveedor2'];
           
            
		
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($conn);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
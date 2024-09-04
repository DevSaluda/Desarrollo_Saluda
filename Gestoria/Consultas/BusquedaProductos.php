<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    include("db_connection.php");
    include "Consultas.php";
    include "Sesion.php";
    
	
$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($conn)
{
	$fetch = mysqli_query($conn,"SELECT * FROM Productos_POS where 	Cod_Barra like '%" . mysqli_real_escape_string($conn,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
        $ID_Prod_POS=$row['ID_Prod_POS'];
        $Cod_Barra=$row['Cod_Barra'];
        
        $Clave_adicional=$row['Clave_adicional'];
        $Nombre_Prod=$row['Nombre_Prod'];
        $Precio_Venta=$row['Precio_Venta'];
        $Precio_C=$row['Precio_C'];
        $Max_Existencia=$row['Max_Existencia'];
        $Min_Existencia=$row['Min_Existencia'];
        $Lote_Med=$row['Lote_Med'];
        $Fecha_Caducidad=$row['Fecha_Caducidad'];
        $Tipo=$row['Tipo'];
        $FkCategoria=$row['FkCategoria'];
        $FkMarca=$row['FkMarca'];
        $FkPresentacion=$row['FkPresentacion'];
        $Proveedor1=$row['Proveedor1'];
        $Proveedor2=$row['Proveedor2'];

        // AQUI VAN LOS ID DE LOS INPUTS
        $row_array['value'] = $row['Cod_Barra']." | ".$row['Nombre_Prod'];
	
        $row_array['nombre_prod']=$row['Nombre_Prod'];
        $row_array['clav']=$row['Clave_adicional'];
        $row_array['loteprod']=$row['Lote_Med'];
        $row_array['fechacaducidad']=$row['Fecha_Caducidad'];
        $row_array['minimo']=$row['Max_Existencia'];
        $row_array['maximo']=$row['Min_Existencia'];

        $row_array['preciocom']=$row['Precio_C'];
         $row_array['precioven']=$row['Precio_Venta'];
         $row_array['categoria']=$row['FkCategoria'];
          $row_array['marca']=$row['FkMarca'];
           $row_array['tipo']=$row['Tipo'];
            $row_array['presentacion']=$row['FkPresentacion'];
            $row_array['revprovee1']=$row['Proveedor1'];
            $row_array['revprovee2']=$row['Proveedor2'];
            $row_array['codigosdebarras']=$row['Cod_Barra'];
            $row_array['id_prod_prod']=$row['ID_Prod_POS'];
            

		
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($conn);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
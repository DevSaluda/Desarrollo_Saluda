<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    include ("db_connection.php");
    include "Consultas.php";
    include "Sesion.php";
    include "Cookiecreada.php";
	
$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($conn)
{

    $fetch = mysqli_query($conn,"SELECT  * FROM Stock_POS where Fk_sucursal='$_COOKIE[Busquedadefinitiva]' AND Cod_Barra like '%" . mysqli_real_escape_string($conn,($_GET['term'])) . "%' OR Nombre_Prod like '%" . mysqli_real_escape_string($conn,($_GET['term'])) . "%' LIMIT 1");
  
    /* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
        $ID_Prod_POS=$row['ID_Prod_POS'];
        $Cod_Barra=$row['Cod_Barra'];
        $Nombre_Prod=$row['Nombre_Prod'];
        $Precio_Venta=$row['Precio_Venta'];
      $Precio_Compra=$row['Precio_C'];
      $Tipo_Servicio=$row['Tipo_Servicio'];
     
        // AQUI VAN LOS ID DE LOS INPUTS
        $row_array['value'] = $row['Cod_Barra']." | ".$row['Nombre_Prod']." | ". 'Piezas en existencia '  .$row['Existencias_R']  ;
        
        $row_array['idprod']=$row['ID_Prod_POS'];
            $row_array['codbarra']=$row['Cod_Barra'];
            $row_array['nombres']=$row['Nombre_Prod'];
            $row_array['precioventa']=$row['Precio_Venta'];
            $row_array['preciodecompra']=$row['Precio_C'];
          
          
           
            
		
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($conn);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
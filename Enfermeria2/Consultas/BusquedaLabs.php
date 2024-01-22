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
    $fetch = mysqli_query($conn,"SELECT
    Productos_POS.Cod_Barra,
    Productos_POS.Tipo_Servicio,
    Productos_POS.Nombre_Prod,
    Productos_POS.Precio_Venta,
    Servicios_POS.Servicio_ID,
    Servicios_POS.Nom_Serv
FROM
    Productos_POS,
    Servicios_POS
WHERE
    Servicios_POS.Nom_Serv = 'Laboratorio'
    AND (
        (Productos_POS.Cod_Barra LIKE 'LAB%' AND Productos_POS.Cod_Barra LIKE '%" . mysqli_real_escape_string($conn, ($_GET['term'])) . "%')
        OR (Productos_POS.Nombre_Prod LIKE '%" . mysqli_real_escape_string($conn, ($_GET['term'])) . "%')
    )
LIMIT 4
");
    /* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
       
        $Cod_Barra=$row['Cod_Barra'];
        $Nombre_Prod=$row['Nombre_Prod'];
        //$Precio_Venta=$row['Precio_Venta'];
        // AQUI VAN LOS ID DE LOS INPUTS
        $row_array['value'] = $row['Cod_Barra']." | ".$row['Nombre_Prod'];
        $row_array['codbarra']=$row['Cod_Barra'];
        $row_array['nombresLab']=$row['Nombre_Prod'];
        //$row_array['precioventa']=$row['Precio_Venta'];
           
            
		
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($conn);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}

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
	$fetch = mysqli_query($conn,"SELECT * FROM Procedimientos_Medicos WHERE Codigo_Procedimiento like '%" .mysqli_real_escape_string($conn,($_GET['term'])) . "%'  LIMIT 0 ,5"); 
	
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
        $Codigo_Procedimiento=$row['Codigo_Procedimiento'];
    
        $Nombre_Procedimiento=$row['Nombre_Procedimiento'];
   
        Costo_Procedimiento
     

        // AQUI VAN LOS ID DE LOS INPUTS
        $row_array['value'] = $row['Codigo_Procedimiento'];
        $row_array['nombres']=$row['Codigo_Procedimiento'];
    
            $row_array['tel']=$row['Nombre_Procedimiento'];
           
            
		
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($conn);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
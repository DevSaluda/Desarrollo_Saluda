<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    include ("db_connection.php");
    include "Consultas.php";
    
    
	
$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($conn)
{
	$fetch = mysqli_query($conn,"SELECT * FROM Data_Pacientes WHERE Nombre_Paciente like '%" .mysqli_real_escape_string($conn,($_GET['term'])) . "%' AND FK_ID_H_O_D ='".$row['ID_H_O_D']."' LIMIT 0 ,5"); 
	
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
        $Nombre_Paciente=$row['Nombre_Paciente'];
    
        $Telefono=$row['Telefono'];
   
        
     

        // AQUI VAN LOS ID DE LOS INPUTS
        $row_array['value'] = $row['Nombre_Paciente'];
        $row_array['nombresExt']=$row['Nombre_Paciente'];
    
            $row_array['telExt']=$row['Telefono'];
           
            
		
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($conn);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
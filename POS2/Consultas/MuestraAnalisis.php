<?
    // include Database connection file 

	include("db_connection.php");
	include "Consultas.php";
	include "Sesion.php";
	

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>No.</th>
							<th>Nombre Analisis</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>';

    $query ="SELECT * FROM `Tipo_analisis` WHERE ID_H_O_D='".$row['ID_H_O_D']."' order by ID_Analisis DESC";
  

	if (!$result = mysqli_query($conn, $query)) {
        exit(mysqli_error($conn));
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($tabla = mysqli_fetch_assoc($result))
    	{
    		$data .= '<tr>
				
			<td>'.$number.'</td>
				<td>'.$tabla['Nombre_analisis'].'</td>
				<td>
					<button onclick="GetUserDetails('.$tabla['ID_Analisis'].')" class="btn btn-warning"><i class="fas fa-edit"></i></button>
				</td>
				<td>
					<button onclick="DeleteUser('.$tabla['ID_Analisis'].')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
				</td>
    		</tr>';
			$number++;
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">No hay registros!</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>
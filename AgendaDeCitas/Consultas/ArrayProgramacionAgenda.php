<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

function fechaCastellano ($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
  }
$sql = "SELECT 
Programacion_MedicosExt.ID_Programacion,
Programacion_MedicosExt.FK_Medico,
Programacion_MedicosExt.Fk_Sucursal,
Programacion_MedicosExt.Tipo_Programacion,
Programacion_MedicosExt.Fecha_Inicio,
Programacion_MedicosExt.ID_H_O_D,
Programacion_MedicosExt.ProgramadoEn,
Programacion_MedicosExt.Fecha_Fin,
Programacion_MedicosExt.Hora_inicio,
Programacion_MedicosExt.Hora_Fin,
Programacion_MedicosExt.Intervalo,
Programacion_MedicosExt.Estatus,
Especialidades_Express.ID_Especialidad,
Especialidades_Express.Nombre_Especialidad,
Personal_Medico_Express.Medico_ID,
Personal_Medico_Express.Especialidad_Express,
Personal_Medico_Express.Nombre_Apellidos,
SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal 
FROM 
Programacion_MedicosExt,
Especialidades_Express,
Personal_Medico_Express,
SucursalesCorre 
WHERE 
Programacion_MedicosExt.FK_Medico = Personal_Medico_Express.Medico_ID 
AND Programacion_MedicosExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
AND Personal_Medico_Express.Especialidad_Express = Especialidades_Express.ID_Especialidad 
AND Programacion_MedicosExt.Estatus <> 'Autorizado' 
AND YEAR(Programacion_MedicosExt.ProgramadoEn) = YEAR(CURRENT_DATE())
ORDER BY 
Programacion_MedicosExt.ProgramadoEn DESC;
";


$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Folio"] = $fila["ID_Programacion"];
    $data[$c]["Nombre"] = $fila["Nombre_Apellidos"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Especialidad"]= $fila["Nombre_Especialidad"];
    $data[$c]["Tipo"] = $fila["Tipo_Programacion"];
    $data[$c]["Periodo"] = $fila["Fecha_Inicio"] . " <br> " . $fila["Fecha_Fin"];
    $data[$c]["Horario"] = date("g:i a",strtotime($fila["Hora_inicio"])) . " <br> " . date("g:i a",strtotime($fila["Hora_Fin"]));
    $data[$c]["AbreFechas"] = '
    <td>
    <a data-id="' . $fila["ID_Programacion"] . '" class="btn btn-success btn-sm btn-AsigSucursal " style="background-color: #C80096 !important;" ><i class="fas fa-calendar"></i></a>
    <a data-id="' . $fila["ID_Programacion"] . '" class="btn btn-success btn-sm btn-EditSucursal " style="background-color: #C80096 !important;" ><i class="fas fa-calendar-week"></i></i></a>
    <a data-id="' . $fila["ID_Programacion"] . '" class="btn btn-danger btn-sm btn-DeleteSucursalDatos " ><i class="fas fa-calendar-times"></i></a>
    </td>'; 
   
    $data[$c]["AbreHorarios"] = '
    <td>
    <a data-id="' . $fila["ID_Programacion"] . '" class="btn btn-success btn-sm btn-NuevaAutorizacionHoras " style="background-color: #C80096 !important;" ><i class="fas fa-user-clock"></i></a>
    <a data-id="' . $fila["ID_Programacion"] . '" class="btn btn-success btn-sm btn-EditHoras " style="background-color: #C80096 !important;" ><i class="fas fa-user-clock"></i></a>
    <a data-id="' . $fila["ID_Programacion"] . '" class="btn btn-danger btn-sm btn-DeleteHoras "><i class="fas fa-user-clock"></i></a>
    </td>';
    
    
   $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>

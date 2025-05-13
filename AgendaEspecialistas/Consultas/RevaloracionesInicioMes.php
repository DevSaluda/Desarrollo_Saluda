
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";


$sql = "SELECT 
Agenda_revaloraciones.Id_genda,
Agenda_revaloraciones.Nombres_Apellidos,
Agenda_revaloraciones.Telefono,
Agenda_revaloraciones.Fk_sucursal,
Agenda_revaloraciones.Medico,
Agenda_revaloraciones.Fecha,
Agenda_revaloraciones.Turno,
Agenda_revaloraciones.Motivo_Consulta,
Agenda_revaloraciones.Agrego,
Agenda_revaloraciones.AgregadoEl,
SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal 
FROM 
Agenda_revaloraciones, SucursalesCorre 
WHERE 
SucursalesCorre.ID_SucursalC = Agenda_revaloraciones.Fk_sucursal
AND Agenda_revaloraciones.Fecha BETWEEN CURRENT_DATE AND CURRENT_DATE + INTERVAL 5 DAY";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
    $data[$c]["Folio"] = $fila["Id_genda"];
    $data[$c]["Paciente"] = $fila["Nombres_Apellidos"];
    $data[$c]["Telefono"] = $fila["Telefono"];
    $data[$c]["Fecha"] = $fila ["Fecha"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Medico"] = $fila["Medico"];
    $data[$c]["Turno"] = $fila["Turno"];
    $data[$c]["MotivoConsulta"] = $fila["Motivo_Consulta"];
    // Llamada a la función fechacastellano para obtener la fecha en formato castellano
$fecha_castellano = fechacastellano($fila["Fecha"]);
$data[$c]["ConWhatsapp"] = ["<a class='btn btn-success' href='https://api.whatsapp.com/send?phone=+52$fila[Telefono];&text=¡Hola $fila[Nombres_Apellidos];! Te contactamos de *Saluda Centro Médico Familiar $fila[Nombre_Sucursal];* para recordatorio de su cita médica con el doctor(a) $fila[Medico]; agendada para el día *$fecha_castellano* en el turno *$fila[Turno];* Agradecemos su pronta confirmación.😃' target='_blank'><span class='fab fa-whatsapp'></span><span class='hidden-xs'></span></a>"];
    $data[$c]["Agendo"] = $fila["Agrego"];
    $data[$c]["RegistradoEl"] = $fila["AgregadoEl"];
    

    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
 
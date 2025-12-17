<?php
// Desactivar errores de visualización para evitar que se muestren en la respuesta
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Asegurar que la sesión esté iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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

// Incluir archivos necesarios
try {
    include("db_connection.php");
    
    // Verificar sesión antes de incluir Consultas.php para evitar redirects en AJAX
    if (!isset($_SESSION['VentasPos'])) {
        echo '<p class="alert alert-warning">Por el momento no hay citas</p>';
        exit;
    }
    
    // Incluir Consultas.php pero evitar que haga redirect
    // Necesitamos definir $row manualmente si Consultas.php no se puede incluir
    $sql_user = "SELECT PersonalPOS.Pos_ID,PersonalPOS.Nombre_Apellidos,PersonalPOS.file_name,PersonalPOS.Fk_Usuario,PersonalPOS.Fk_Sucursal,PersonalPOS.ID_H_O_D,PersonalPOS.Estatus,
    Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,SucursalesCorre.Cuenta_Clip,SucursalesCorre.Clave_Clip,SucursalesCorre.EstadoSucursalInv 
    FROM PersonalPOS,Roles_Puestos,SucursalesCorre 
    WHERE PersonalPOS.Fk_Usuario = Roles_Puestos.ID_rol AND PersonalPOS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND PersonalPOS.Pos_ID='".$_SESSION['VentasPos']."'";
    
    $resultset = mysqli_query($conn, $sql_user);
    if ($resultset && mysqli_num_rows($resultset) > 0) {
        $row = mysqli_fetch_assoc($resultset);
        if ($row['Estatus'] != "Vigente") {
            echo '<p class="alert alert-warning">Por el momento no hay citas</p>';
            exit;
        }
    } else {
        echo '<p class="alert alert-warning">Por el momento no hay citas</p>';
        exit;
    }
} catch (Exception $e) {
    echo '<p class="alert alert-warning">Por el momento no hay citas</p>';
    exit;
}

// Verificar que $row esté definido y tenga los datos necesarios
if (!isset($row) || empty($row) || !isset($row['Fk_Sucursal']) || !isset($row['ID_H_O_D'])) {
    echo '<p class="alert alert-warning">Por el momento no hay citas</p>';
    exit;
}

$user_id=null;
$sql1="SELECT AgendaCitas_EspecialistasSucursales.ID_Agenda_Especialista,AgendaCitas_EspecialistasSucursales.Fk_Especialidad,AgendaCitas_EspecialistasSucursales.Fk_Especialista,
AgendaCitas_EspecialistasSucursales.Fk_Sucursal,AgendaCitas_EspecialistasSucursales.Fecha,AgendaCitas_EspecialistasSucursales.ID_H_O_D,
AgendaCitas_EspecialistasSucursales.Hora,AgendaCitas_EspecialistasSucursales.Nombre_Paciente,AgendaCitas_EspecialistasSucursales.Telefono,AgendaCitas_EspecialistasSucursales.Observaciones,
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,
Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Fechas_Especialistas_Sucursales.ID_Fecha_Esp,Fechas_Especialistas_Sucursales.Fecha_Disponibilidad,Horarios_Citas_Sucursales.ID_Horario,Horarios_Citas_Sucursales.Horario_Disponibilidad FROM AgendaCitas_EspecialistasSucursales,SucursalesCorre,Roles_Puestos,Personal_Medico,Fechas_Especialistas_Sucursales,Horarios_Citas_Sucursales 
where AgendaCitas_EspecialistasSucursales.Fk_Especialidad = Roles_Puestos.ID_rol AND Fechas_Especialistas_Sucursales.Fecha_Disponibilidad BETWEEN CURDATE() and CURDATE() + INTERVAL 4 DAY AND
AgendaCitas_EspecialistasSucursales.Fk_Especialista= Personal_Medico.Medico_ID AND AgendaCitas_EspecialistasSucursales.Fk_Sucursal= SucursalesCorre.ID_SucursalC 
AND AgendaCitas_EspecialistasSucursales.Fecha = Fechas_Especialistas_Sucursales.ID_Fecha_Esp AND AgendaCitas_EspecialistasSucursales.Fk_Sucursal='".$row['Fk_Sucursal']."' AND AgendaCitas_EspecialistasSucursales.Hora = Horarios_Citas_Sucursales.ID_Horario  AND  AgendaCitas_EspecialistasSucursales.ID_H_O_D='".$row['ID_H_O_D']."'";

try {
    $query = $conn->query($sql1);
    if (!$query) {
        throw new Exception("Error en la consulta: " . $conn->error);
    }
} catch (Exception $e) {
    echo '<p class="alert alert-warning">Por el momento no hay citas</p>';
    exit;
}
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CajasSucursales" class="table table-hover">
<thead>
<th>Folio</th>
<th>Paciente</th>
<th>Telefono</th>
<th>Fecha | Hora </th>
<th>Especialidad | Doctor</th>
<th>Sucursal</th>
<th>Observaciones</th>



</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

    <td> <?php echo $Usuarios["ID_Agenda_Especialista"]; ?></td>
    <td> <?php echo $Usuarios["Nombre_Paciente"]; ?></td>
    <td> <?php echo $Usuarios["Telefono"]; ?></td>
    <td> <?php echo fechaCastellano($Usuarios["Fecha_Disponibilidad"]); ?> <br>
    <?php echo date('h:i A', strtotime(($Usuarios["Horario_Disponibilidad"]))); ?></td>
    <td> <?php echo  $Usuarios["Nombre_rol"]; ?> <br>
    <?php echo $Usuarios["Nombre_Apellidos"]; ?></td>
    <td> <?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td> <?php echo $Usuarios["Observaciones"]; ?></td>

   
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Por el momento no hay citas</p>
<?php endif;?>
  <!-- Modal -->
  <!-- Script de DataTables movido a ControlCampanasDiasSucursalesV2.js para evitar conflictos de timing -->
   
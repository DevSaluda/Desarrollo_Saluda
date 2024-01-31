<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";



$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Ventas_POS.Folio_Ticket,Ventas_POS.Fk_Caja,Ventas_POS.Venta_POS_ID,Ventas_POS.Identificador_tipo,Ventas_POS.Cod_Barra,Ventas_POS.FormaDePago,Ventas_POS.Fecha_venta,
Ventas_POS.Clave_adicional,Ventas_POS.Total_Venta,Ventas_POS.Importe,Ventas_POS.Total_VentaG,Ventas_POS.CantidadPago,
Ventas_POS.Cambio,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv, Ventas_POS.Nombre_Prod,Ventas_POS.Cantidad_Venta,Ventas_POS.
Fk_sucursal,Ventas_POS.AgregadoPor,Ventas_POS.AgregadoEl, Ventas_POS.Lote,Ventas_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal
 FROM Ventas_POS,SucursalesCorre,Servicios_POS WHERE Ventas_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC  AND Ventas_POS.Folio_Ticket= '".$_POST["id"]."' AND
 Ventas_POS.Fk_sucursal= '".$row['Fk_Sucursal']."' AND Ventas_POS.AgregadoPor='".$row['Nombre_Apellidos']."' AND Ventas_POS.Identificador_tipo=Servicios_POS.Servicio_ID";
 

$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
  $user_id=null;
  $sql2= "SELECT Ventas_POS.Folio_Ticket,Ventas_POS.Fk_Caja,Ventas_POS.Venta_POS_ID,Ventas_POS.Identificador_tipo,Ventas_POS.Cod_Barra,Ventas_POS.Turno,Ventas_POS.DescuentoAplicado,Ventas_POS.Fecha_venta,
  Ventas_POS.FormaDePago,
  Ventas_POS.Clave_adicional,Ventas_POS.Total_Venta,Ventas_POS.Importe,Ventas_POS.Total_VentaG,Ventas_POS.CantidadPago,
  Ventas_POS.Cambio,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv, Ventas_POS.Nombre_Prod,Ventas_POS.Cantidad_Venta,Ventas_POS.
  Fk_sucursal,Ventas_POS.AgregadoPor,Ventas_POS.AgregadoEl, Ventas_POS.Lote,Ventas_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal
   FROM Ventas_POS,SucursalesCorre,Servicios_POS WHERE Ventas_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC  AND Ventas_POS.Folio_Ticket= '".$_POST["id"]."' AND
   Ventas_POS.Fk_sucursal= '".$row['Fk_Sucursal']."'   AND Ventas_POS.AgregadoPor='".$row['Nombre_Apellidos']."' AND Ventas_POS.Identificador_tipo=Servicios_POS.Servicio_ID";
   $query = $conn->query($sql2);
?>



<?php if($Especialistas!=null):?>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">N° Ticket</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"> <i class="fas fa-info-circle"></i></span>
  </div>
  <input type="text" class="form-control" readonly value="<?php echo $Especialistas->Folio_Ticket; ?>">
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"> <i class="fas fa-info-circle"></i></span>
  </div>
  <input type="text" class="form-control" readonly value="<?php echo $Especialistas->Nombre_Sucursal; ?>">
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Vendedor</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"> <i class="fas fa-info-circle"></i></span>
  </div>
  <input type="text" class="form-control" readonly value="<?php echo $Especialistas->	AgregadoPor; ?>">
    </div>
    </div>
   </div>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="HistorialCajas" class="table table-hover">
<thead>

<th>Servicio</th>
<th>Cod barra</th>
<th>Prod</th>
<th>Lote</th>
<th>Cantidad</th>
<th>P.U</th>
<th>Descuento</th>
<th>Importe</th>

<th>Fecha | Hora</th>
    <th>Vendedor</th>
    



</thead>
<?php while ($Tickets=$query->fetch_array()):?>
<tr>

<td><?php echo $Tickets["Nom_Serv"]; ?></td>
    
<td><?php echo $Tickets["Cod_Barra"]; ?></td>
<td><?php echo $Tickets["Nombre_Prod"]; ?></td>
<td><?php echo $Tickets["Lote"]; ?></td>
<td><?php echo $Tickets["Cantidad_Venta"]; ?></td>
<td><?php echo $Tickets["Total_Venta"]; ?></td>
<td><?php echo $Tickets["DescuentoAplicado"]; ?> %</td>
<td><?php echo $Tickets["Importe"]; ?></td>
    <td><?php echo fechaCastellano($Tickets["AgregadoEl"]); ?> <br>
    <?php echo date("g:i a",strtotime($Tickets["AgregadoEl"])); ?>
  </td>
  <td><?php echo $Tickets["AgregadoPor"]; ?></button></td>
     
      
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Total de venta</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"> <i class="fas fa-info-circle"></i></span>
  </div>
  <input type="text" class="form-control" readonly value="<?php echo $Especialistas->Total_VentaG; ?>">
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">El cliente pago </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"> <i class="fas fa-info-circle"></i></span>
  </div>
  <input type="text" class="form-control" readonly value="<?php echo $Especialistas->CantidadPago; ?>">
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Cambio</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"> <i class="fas fa-info-circle"></i></span>
  </div>
  <input type="text" class="form-control" readonly value="<?php echo $Especialistas->Cambio; ?>">
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Forma de pago</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"> <i class="fas fa-info-circle"></i></span>
  </div>
  <input type="text" class="form-control" readonly value="<?php echo $Especialistas->FormaDePago; ?>">
    </div>
    </div>
   </div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>

  
<?php else:?>
  <p class="alert alert-danger">404 No se encuentra  <br>El ticket puede corresponder a un crédito, te sugerimos revisar el área de créditos  </p>
<?php endif;?>
<?php

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
?>
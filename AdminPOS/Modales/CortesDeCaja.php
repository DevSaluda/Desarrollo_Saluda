<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Venta_POS_ID,Folio_Ticket,Fk_Caja,Fk_sucursal,ID_H_O_D FROM Ventas_POS WHERE Fk_Caja = '".$_POST['id']."'  
AND ID_H_O_D='".$row['ID_H_O_D']."' order by  Venta_POS_ID ASC limit 1";
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
  $sql2= "SELECT Venta_POS_ID,Folio_Ticket,Fk_Caja,Fk_sucursal,ID_H_O_D FROM Ventas_POS WHERE Fk_Caja = '".$_POST['id']."' 
  AND ID_H_O_D='".$row['ID_H_O_D']."' order by  Venta_POS_ID DESC limit 1";
  $query = $conn->query($sql2);
  $Especialistas2 = null;
  if($query->num_rows>0){
  while ($r=$query->fetch_object()){
    $Especialistas2=$r;
    break;
  }
  
    }
    $sql3= "SELECT Venta_POS_ID,Fk_Caja,Fk_sucursal,ID_H_O_D,COUNT( DISTINCT Folio_Ticket) AS Total_tickets,SUM(Importe) AS VentaTotal  FROM Ventas_POS where ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Caja = ".$_POST["id"];
  $query = $conn->query($sql3);
  $Especialistas3 = null;
  if($query->num_rows>0){
  while ($r=$query->fetch_object()){
    $Especialistas3=$r;
    break;
  }
  
    }
    $sql4= "SELECT Identificador_tipo,Fk_Caja,SUM(Importe) as totaldentalescreditos FROM `Ventas_POS` WHERE Identificador_tipo='Cr&eacute;ditos' AND Fk_Caja = ".$_POST["id"];
  $query = $conn->query($sql4);
  $Especialistas4 = null;
  if($query->num_rows>0){
  while ($r=$query->fetch_object()){
    $Especialistas4=$r;
    break;
  }
  
    }
    $sql6= "SELECT Nombre_Cred,Fk_tipo_Credi,Fk_Caja,SUM(Cant_Abono) as deudatotal FROM `AbonoCreditos_Clinicas_POS`  WHERE Fk_Caja = '".$_POST['id']."' GROUP by Nombre_Cred,Fk_tipo_Credi";
    $query = $conn->query($sql6);
    $Especialistas6 = null;
    if($query->num_rows>0){
    while ($r=$query->fetch_object()){
      $Especialistas6=$r;
      break;
    }
    
      }
    $sql5="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja,
Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,
Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as totaldeservicios FROM
 Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID 
 AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' 
  GROUP by Servicios_POS.Servicio_ID";
$query = $conn->query($sql5);


?>
<?php if($Especialistas!=null):?>


  
  <form action="javascript:void(0)" method="post" id="CierreDeCaja" >


  
   
   <div class="row">
<div class="col">
    <label for="exampleFormControlInput1">Ticket inicial<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  id="ticketinicial" name="TicketInicial"  readonly value="<?php echo $Especialistas->Folio_Ticket; ?>">           
  
</div></div>
<div class="col">
    <label for="exampleFormControlInput1">Ticket final<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  id="ticketinicial" name="TicketFinal"  readonly value="<?php echo $Especialistas2->Folio_Ticket; ?>">           
  
</div></div></div>
<div class="row">
<div class="col">
    <label for="exampleFormControlInput1">TotalTickets<span class="text-danger">*</span></label>
     <div class="input-group mb-3"> 
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
          
  <input type="text" class="form-control "  name="TotalTickets"readonly value="<?php echo $Especialistas3->Total_tickets; ?>" aria-describedby="basic-addon1" maxlength="60"> 
  <input type="text" class="form-control "  hidden name="NumeroCaja"readonly value="<?php echo $Especialistas3->Fk_Caja; ?>" aria-describedby="basic-addon1" maxlength="60">
  <input type="text" class="form-control "   hidden name="FkSucursalL"readonly value="<?php echo $Especialistas3->Fk_sucursal; ?>" aria-describedby="basic-addon1" maxlength="60"> 
</div></div>
<div class="col">
    <label for="exampleFormControlInput1">Total de venta<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control "  id="cantidadtotalventas" name="TotalCaja" step="any" readonly value="<?php echo $Especialistas3->VentaTotal; ?>" aria-describedby="basic-addon1" >             
  
</div></div>
</div>
</div>




<input type="text" class="form-control " hidden  readonly name="Usuario" id="usuario"  readonly value="<?php echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistema" name="Sistema" readonly value="POS <?php echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden  readonly id="empresa" name="Empresa" readonly value="<?php echo $row['ID_H_O_D']?>">


<button type="submit"  id="submit"  class="btn btn-warning">Realizar corte <i class="fas fa-money-check-alt"></i></button>
                          
</form>




<script src="js/GuardaCorte.js"></script>
<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>

<script type="text/javascript">

    function habilitar()

    {

        var camp1= document.getElementById('cantidadtotalventas');
        var camp2= document.getElementById('resultadototalventas');
        var boton= document.getElementById('submit');

        if (camp1.value != camp2.value) {
         
          document.getElementById("Ok").className = "alert alert-danger";
            document.getElementById("Ok").innerHTML="El valor total del conteo de billetes y monedas no coincide con el total de venta, verifica e intentalo de nuevo";
           
            boton.disabled = true;
        a}else {
            boton.disabled = false;
            document.getElementById("Ok").className = "alert alert-success";
            document.getElementById("Ok").innerHTML="El valor total del conteo de billetes y monedas coincide con la suma del total de billetes y monedas";
            // div = document.getElementById('contador');
            // div.style.display = 'none';
           
        }
    }



</script>
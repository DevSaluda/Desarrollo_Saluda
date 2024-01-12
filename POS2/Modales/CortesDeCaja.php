<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
include "../Consultas/ConsultaCaja.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Venta_POS_ID,Folio_Ticket,Fk_Caja,Fk_sucursal,ID_H_O_D FROM Ventas_POS WHERE Fk_Caja = '".$_POST['id']."' AND Fk_Caja = '".$ValorCaja['ID_Caja']."' AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
AND ID_H_O_D='".$row['ID_H_O_D']."' order by  Venta_POS_ID ASC limit 1";
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
  $sql2= "SELECT Venta_POS_ID,Folio_Ticket,Fk_Caja,Fk_sucursal,ID_H_O_D FROM Ventas_POS WHERE Fk_Caja = '".$_POST['id']."' AND Fk_Caja = '".$ValorCaja['ID_Caja']."' AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
  AND ID_H_O_D='".$row['ID_H_O_D']."' order by  Venta_POS_ID DESC limit 1";
  $query = $conn->query($sql2);
  $Especialistas2 = null;
  if($query->num_rows>0){
  while ($r=$query->fetch_object()){
    $Especialistas2=$r;
    break;
  }
  
    }
  $sql3= "SELECT Venta_POS_ID,Fk_Caja,Fk_sucursal,Turno,ID_H_O_D,COUNT( DISTINCT Folio_Ticket) AS Total_tickets,SUM(Importe) AS VentaTotal  FROM Ventas_POS where FormaDePago='Efectivo' AND Fk_Caja = '".$ValorCaja['ID_Caja']."' AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
 AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Caja = ".$_POST["id"];
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
    $sql6="SELECT Venta_POS_ID,Fk_Caja,Fk_sucursal,Turno,ID_H_O_D,COUNT( DISTINCT Folio_Ticket) AS Total_tickets,SUM(Importe) AS VentaTotalCredito  FROM Ventas_POS where FormaDePago='Crédito Enfermería' AND Fk_Caja = '".$ValorCaja['ID_Caja']."' AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
    AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Caja = ".$_POST["id"];
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

$sql8="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,
Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja, Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.
Nombre_Sucursal,Ventas_POS.FormaDePago, Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as totalesdepago
 FROM Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' GROUP by Ventas_POS.FormaDePago";
$query8 = $conn->query($sql8);

?>

<? if($Especialistas!=null):?>

  <form method="post" 
      target="print_popup" 
      action="http://localhost:8080/ticket/CierreDeCaja.php"
      onsubmit="window.open('about:blank','print_popup','width=600,height=600');"  id="GeneraTicketCierreCaja">

   
      <input type="text" class="form-control "   readonly name="VendedorTicket"  readonly value="<?echo $row['Nombre_Apellidos']?>">
      <input type="number" class="form-control "  step="any" name="TotalCajaTicket" id="resultadototalventasTicket" readonly   aria-describedby="basic-addon1" >
      <input type="text" class="form-control " id="ticketiniciall" name="TicketInicialTicket"  readonly value="<? echo $Especialistas->Folio_Ticket; ?>">
      <input type="text" class="form-control " id="ticketfinall" name="TicketFinalTicket" readonly value="<? echo $Especialistas2->Folio_Ticket; ?>" aria-describedby="basic-addon1" maxlength="60">            
      <input type="text" class="form-control "  name="TotalTicketsTickets"readonly value="<? echo $Especialistas3->Total_tickets; ?>" aria-describedby="basic-addon1" maxlength="60">            
      <input type="number" class="form-control "  id="cantidadtotalventas" name="TicketVentasTotl" step="any" readonly value="<? echo $Especialistas3->VentaTotal; ?>" aria-describedby="basic-addon1" >
      <input type="datetime" name="Horadeimpresion" value="<?echo date('h:i:s A');?>">
      <input type="datetime" name="FechaDelCorte" value="<?echo date("Y-m-d");?>">
      <input type="text" class="form-control" name="Sucursal" readonly  value="<?echo $row['Nombre_Sucursal']?>" aria-describedby="basic-addon1" >   
      <input type="number" class="form-control "  step="any" name="Totaldentales"  readonly   value="<? echo $Especialistas4->totaldentalescreditos; ?>" aria-describedby="basic-addon1" >
      <input type="text" class="form-control "   name="TotalCreditoEnfermeria"  readonly value="<? echo $Especialistas6->VentaTotalCredito; ?>" aria-describedby="basic-addon1" >  
      <input type="text" class="form-control "   name="TurnoCorteticket"  readonly value="<? echo $Especialistas3->Turno; ?>" aria-describedby="basic-addon1" >  
      <?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="TotalesGeneralesCortes" class="table table-hover">
<thead>

<th>Sucursal</th>
<th>Vendedor</th>
<th>Nombre Servicio</th>

    <th>Total</th>
    
    
    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td> <?php echo $Usuarios["AgregadoPor"]; ?></td>
    <td> <input type="text" class="form-control "  name="NombreServicio[]"readonly value="<?php echo $Usuarios["Nom_Serv"]; ?>"></td>
    <td><input type="text" class="form-control "  name="TotalServicio[]"readonly value="<?php echo $Usuarios["totaldeservicios"]; ?>"></td>
   
    
		
</tr> 
<?php endwhile;?>
</table>
</div>
</div> 
<?php if($query8->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="TotalesFormaPAgoCortes" class="table table-hover">
<thead>

<th>Sucursal</th>
<th>Vendedor</th>
<th>Nombre Servicio</th>

    <th>Total</th>
    
    
    


</thead>
<?php while ($Usuarios2=$query8->fetch_array()):?>
<tr>
 


    <td><?php echo $Usuarios2["Nombre_Sucursal"]; ?></td>
    <td> <?php echo $Usuarios2["AgregadoPor"]; ?></td>
   
    <td> <input type="text" class="form-control "  name="NombreFormaPago[]"readonly value="<?php echo $Usuarios2["FormaDePago"]; ?>"></td>
    <td><input type="text" class="form-control "  name="TotalFormasPagos[]"readonly value="<?php echo $Usuarios2["totalesdepago"]; ?>"></td>
    
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>  
<?php else:?>
	<p class="alert alert-warning">Aún no hay totales registrados </p>
<?php endif;?><?php else:?>
	<p class="alert alert-warning">Aún no hay totales registrados </p>
<?php endif;?>
      <button type="submit"  id="EnviaTicket"  class="btn btn-info">Realizar abono <i class="fas fa-money-check-alt"></i></button>
</form>

<form action="javascript:void(0)" method="post" id="FinalizaAsignacion" >


<input type="text" class="form-control "  id="" name="IDdeCajaAsignada"  readonly value="<? echo $Especialistas->Fk_Caja; ?>">

<button type="submit"  id="finasignacion"  class="btn btn-warning">Realizar corte <i class="fas fa-money-check-alt"></i></button>
</form>

<!-- CAMBIA ASIGNACION -->
<form action="javascript:void(0)" method="post" id="CierreDeCaja" >


  <input type="text" class="form-control " hidden id="ticketinicial" name="TicketInicial"  readonly value="<? echo $Especialistas->Folio_Ticket; ?>">
  
  <input type="text" class="form-control " hidden id="numerocaja" name="NumeroCaja"  readonly value="<? echo $Especialistas->Fk_Caja; ?>">
    
   
   <input type="text" class="form-control "hidden  id="ticketfinal" name="TicketFinal" readonly value="<? echo $Especialistas2->Folio_Ticket; ?>" aria-describedby="basic-addon1" maxlength="60">            
   <input type="text" class="form-control " hidden id="fksucursall" name="FkSucursalL" readonly value="<? echo $Especialistas2->Fk_sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">
   
   <div class="row">
<div class="col">
    <label for="exampleFormControlInput1">Total de tickets<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  name="TotalTickets"readonly value="<? echo $Especialistas3->Total_tickets; ?>" aria-describedby="basic-addon1" maxlength="60">            
  
</div></div>
<div class="col">
    <label for="exampleFormControlInput1">Total de venta<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
          
  <input type="number" class="form-control "  id="cantidadtotalventas" name="Cantidad" step="any" readonly value="<? echo $Especialistas3->VentaTotal; ?>" aria-describedby="basic-addon1" >  
</div></div>
<div class="col">
    <label for="exampleFormControlInput1">Conteo de billetes<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control " onfocus="habilitar();" step="any" name="TotalCaja" id="resultadototalventas" readonly   aria-describedby="basic-addon1" >                
  
</div></div>
<div class="col">
    <label for="exampleFormControlInput1">Turno<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
          
  <input type="text" class="form-control "  id="turno" name="TurnoCorte"  readonly value="<? echo $Especialistas3->Turno; ?>" aria-describedby="basic-addon1" >  
</div></div>
</div>
</div>


<div class="" id="Ok" role="alert">
  
</div>
</div>
<div id="contador" class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Billetes</label>
    <div class="table-responsive" style="background-color: #2bbbad !important;color: white;">
  <table class="table table-bordered" style="background-color: #2bbbad !important;color: white;">
  <thead>
    <tr>
       <th scope="col" style="background-color: #2bbbad !important;color: white;">Cantidad</th>
       <th scope="col" style="background-color: #2bbbad !important;color: white;">Valor</th>
       <th scope="col" style="background-color: #2bbbad !important;color: white;">Total</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td><input type="number" class="form-control "  id="billetemil" name="BilleteMil"onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td> <input type="number" class="form-control " hidden id="mil" value="1000.00" aria-describedby="basic-addon1" >$1000.00 </td>
     <td><input type="number" class="subtotal form-control  "  step="any" id="resultadomil" onchange="multiplicar();"  aria-describedby="basic-addon1" ></td>
     
    </tr>
    <tr>
<td><input type="number" class="form-control "  id="billequinie" name="BilleteQuinie"  onchange="multiplicar();"aria-describedby="basic-addon1" ></td>
     <td> <input type="number" class="form-control " hidden id="quinientos" value="500.00" aria-describedby="basic-addon1" >$500.00 </td>
     <td><input type="number" class="subtotal form-control  "  step="any" readonly id="resultadoquinientos" onchange="multiplicar();"  aria-describedby="basic-addon1" ></td>
     
    </tr>
    <tr>
<td><input type="number" class="form-control "   id="billedos" name="BilleteDos"onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td><input type="number" class="form-control " hidden id="doscientos" value="200.00" aria-describedby="basic-addon1" > $200.00 </td>
     <td><input type="number" class="form-control " step="any"  readonly id="resultadodoscioentos"aria-describedby="basic-addon1" ></td>
     
    </tr>
    <tr>
<td><input type="number" class="form-control "   id="billecien" name="BilleteCien"onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td><input type="number" class="form-control " hidden id="cien" value="100.00" aria-describedby="basic-addon1" > $100.00 </td>
     <td><input type="number" class="form-control "  id="resultadocien" readonly aria-describedby="basic-addon1" ></td>  
    </tr>
    <tr>
<td><input type="number" class="form-control "  id="billecincuenta" name="BilleteCincuenta"onchange="multiplicar();"  aria-describedby="basic-addon1" ></td>
     <td> <input type="number" class="form-control " hidden id="cincuenta" value="50.00" aria-describedby="basic-addon1"> $50.00 </td>
     <td><input type="number" class="form-control " step="any"  id="resultadocincuenta" readonly aria-describedby="basic-addon1" ></td>  
    </tr>
    <tr>
<td><input type="number" class="form-control "  id="billeveinte" name="BilleteVeinte" onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td><input type="number" class="form-control " hidden id="veinte" value="20.00" aria-describedby="basic-addon1" > $20.00 </td>
     <td><input type="number" class="form-control "   step="any" id="resultadoveinte" readonly aria-describedby="basic-addon1" ></td>  
    </tr>
    <tr>
    <td><input type="number" class="form-control "   id="monedaCincoc" name="MonedaCincoC" onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td><input type="number" class="form-control " hidden id="cincocc"step="any" value="0.05" aria-describedby="basic-addon1" > $0.5 </td>
     <td><input type="number" class="form-control "  step="any" id="resultadocincocc" aria-describedby="basic-addon1" ></td>  
    </tr>
  </tbody>
</table>
</div>
    </div>
    
   
    <div class="col">
    <label for="exampleFormControlInput1">Monedas<span class="text-danger">*</span></label>
    <div class="table-responsive" style="background-color: #2bbbad !important;color: white;">
  <table class="table table-bordered" style="background-color: #2bbbad !important;color: white;">
  <thead>
    <tr>
       <th scope="col" style="background-color: #2bbbad !important;color: white;">Cantidad</th>
       <th scope="col" style="background-color: #2bbbad !important;color: white;">Valor</th>
       <th scope="col" style="background-color: #2bbbad !important;color: white;">Total</th>
    
    </tr>
  </thead>
  <tbody>
    
    <tr>
<td><input type="number" class="form-control "    id="monedadiez" name="MonedaDiez" onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td> <input type="number" class="form-control " hidden id="diez" value="10.00" aria-describedby="basic-addon1" >$10.00 </td>
     <td><input type="number" class="form-control "  step="any" id="resultadodiez" aria-describedby="basic-addon1" ></td>  
    </tr>
    <tr>
<td><input type="number" class="form-control "    id="modenacinco" name="MonedaCinco" onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td><input type="number" class="form-control " hidden id="cinco" value="5.00" aria-describedby="basic-addon1" > $5.00 </td>
     <td><input type="number" class="form-control "  step="any"  id="resultadocinco"aria-describedby="basic-addon1" ></td>  
    </tr>
    <tr>
<td><input type="number" class="form-control "   id="monedados" name="MonedaDos" onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td><input type="number" class="form-control " hidden id="dos" value="2.00" aria-describedby="basic-addon1" > $2.00 </td>
     <td><input type="number" class="form-control "  step="any" id="resultadodos" aria-describedby="basic-addon1" ></td>  
    </tr>
    <tr>
<td><input type="number" class="form-control "  id="monedapeso" name="MonedaPeso" onchange="multiplicar();"  aria-describedby="basic-addon1" ></td>
     <td><input type="number" class="form-control " hidden id="peso" value="1.00" aria-describedby="basic-addon1" > $1.00 </td>
     <td><input type="number" class="form-control "  step="any" id="resultadopeso" aria-describedby="basic-addon1" ></td>  
    </tr>
    <tr>
<td><input type="number" class="form-control "  id="monedacincuenta" name="MonedaCincuenta" onchange="multiplicar();"  aria-describedby="basic-addon1" ></td>
     <td> <input type="number" class="form-control " hidden id="cincuentac" step="any" value="0.50" aria-describedby="basic-addon1" >$0.50 </td>
     <td><input type="number" class="form-control " step="any"  id="resultadocincuentac"aria-describedby="basic-addon1" ></td>  
    </tr>
    <td><input type="number" class="form-control "  id="monedaveinte" name="MonedaVeinte" onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td><input type="number" class="form-control " hidden id="veintec"step="any" value="0.20" aria-describedby="basic-addon1" > $0.20 </td>
     <td><input type="number" class="form-control "   step="any" id="resultadoveintec"aria-describedby="basic-addon1" ></td>  
    </tr>
    <td><input type="number" class="form-control "   id="monedadiezc" name="MonedaDiezC" onchange="multiplicar();" aria-describedby="basic-addon1" ></td>
     <td><input type="number" class="form-control " hidden id="diezc"step="any" value="0.10" aria-describedby="basic-addon1" > $0.10 </td>
     <td><input type="number" class="form-control "  step="any" id="resultadodiezc" aria-describedby="basic-addon1" ></td>  
    </tr>
  </tbody>
</table>
</div> 
  </div></div>
   
  
<input type="text" class="form-control " hidden  readonly name="Usuario" id="usuario"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistema" name="Sistema" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden  readonly id="empresa" name="Empresa" readonly value="<?echo $row['ID_H_O_D']?>">


<button type="submit"  id="submit"  class="btn btn-warning">Realizar corte <i class="fas fa-money-check-alt"></i></button>
                          
</form>


<script src="js/ContadorDineroCorte.js"></script>
<script src="js/FinalizaAsignacion.js"></script>
<script src="js/GuardaCorte.js"></script>
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

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

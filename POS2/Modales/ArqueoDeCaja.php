<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
include "../Consultas/ConsultaCaja.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Venta_POS_ID,Folio_Ticket,Fk_Caja,Fk_sucursal,ID_H_O_D FROM Ventas_POS WHERE Fk_Caja = '".$_POST['id']."'  AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
AND ID_H_O_D='".$row['ID_H_O_D']."' order by  Venta_POS_ID ASC limit 1";
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
  $sql2= "SELECT Venta_POS_ID,Folio_Ticket,Fk_Caja,Fk_sucursal,ID_H_O_D FROM Ventas_POS WHERE Fk_Caja = '".$_POST['id']."'  AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
  AND ID_H_O_D='".$row['ID_H_O_D']."' order by  Venta_POS_ID DESC limit 1";
  $query = $conn->query($sql2);
  $Especialistas2 = null;
  if($query->num_rows>0){
  while ($r=$query->fetch_object()){
    $Especialistas2=$r;
    break;
  }
  
    }
  $sql3= "SELECT Venta_POS_ID,Fk_Caja,Turno,Fecha_venta,Fk_sucursal,AgregadoPor,Turno,ID_H_O_D,COUNT(DISTINCT Folio_Ticket)AS Total_tickets,
  COUNT(DISTINCT FolioSignoVital ) AS Total_Folios,SUM(Importe) AS VentaTotal  FROM Ventas_POS where  Fk_sucursal ='".$row['Fk_Sucursal']."' 
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
    $sql6="SELECT Venta_POS_ID,Fk_Caja,Fk_sucursal,Turno,ID_H_O_D,COUNT( DISTINCT Folio_Ticket) AS Total_tickets,SUM(Importe) AS VentaTotalCredito  FROM Ventas_POS where FormaDePago='Crédito Enfermería'  AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
    AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Caja = ".$_POST["id"];
    $query = $conn->query($sql6);
    $Especialistas6 = null;
    if($query->num_rows>0){
    while ($r=$query->fetch_object()){
      $Especialistas6=$r;
      break;
    }
    
      }

      $sql7="SELECT Venta_POS_ID,Fk_Caja,Fk_sucursal,Turno,ID_H_O_D,COUNT( DISTINCT Folio_Ticket) AS Total_tickets,SUM(Importe) AS VentaTotalCreditoLimpieza  FROM Ventas_POS where FormaDePago='Crédito Limpieza'  AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
    AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Caja = ".$_POST["id"];
    $query = $conn->query($sql7);
    $Especialistas7 = null;
    if($query->num_rows>0){
    while ($r=$query->fetch_object()){
      $Especialistas7=$r;
      break;
    }
    
      }
      $sql11="SELECT Venta_POS_ID,Fk_Caja,Fk_sucursal,Turno,ID_H_O_D,COUNT( DISTINCT Folio_Ticket) AS Total_tickets,SUM(Importe) AS VentaTotalCreditoFarmaceutico FROM Ventas_POS where FormaDePago='Crédito Farmacéutico'  AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
      AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Caja = ".$_POST["id"];
      $query = $conn->query($sql11);
      $Especialistas11 = null;
      if($query->num_rows>0){
      while ($r=$query->fetch_object()){
        $Especialistas11=$r;
        break;
      }
      
        }

        $sql12="SELECT Venta_POS_ID,Fk_Caja,Fk_sucursal,Turno,ID_H_O_D,COUNT( DISTINCT Folio_Ticket) AS Total_tickets,SUM(Importe) AS VentaTotalCreditoMedicos FROM Ventas_POS where FormaDePago='Crédito Médico'  AND Fk_sucursal ='".$row['Fk_Sucursal']."' 
        AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Caja = ".$_POST["id"];
        $query = $conn->query($sql12);
        $Especialistas12 = null;
        if($query->num_rows>0){
        while ($r=$query->fetch_object()){
          $Especialistas12=$r;
          break;
        }
        
          }


          $sql13="SELECT * FROM `Cortes_Cajas_POS` where  Sucursal ='".$row['Fk_Sucursal']."' 
          AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Caja = ".$_POST["id"];
          $query = $conn->query($sql13);
          $Especialistas13 = null;
          if($query->num_rows>0){
          while ($r=$query->fetch_object()){
            $Especialistas13=$r;
            break;
          }
          
            }

            $sql14="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja,
            Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,
            Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as totaldeservicios FROM
             Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID 
             AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC  AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' 
              GROUP by Servicios_POS.Servicio_ID";
            $query = $conn->query($sql14);
            $Especialistas14 = null;
            if($query->num_rows>0){
            while ($r=$query->fetch_object()){
              $Especialistas14=$r;
              break;
            }
            
              }

              




              $sql20="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,
              Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja, Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.
              Nombre_Sucursal,Ventas_POS.FormaDePago, Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as VentaTotalDeEfectivo
               FROM Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' 
               AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND Ventas_POS.FormaDePago='Efectivo'AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' ";
            $query = $conn->query($sql20);
            $Especialistas20 = null;
            if($query->num_rows>0){
            while ($r=$query->fetch_object()){
              $Especialistas20=$r;
              break;
            }
            
              }


              $sql21="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,
              Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja, Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.
              Nombre_Sucursal,Ventas_POS.FormaDePago, Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as VentaTotalTarjeta
               FROM Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' 
               AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND Ventas_POS.FormaDePago='Tarjeta'";
            $query = $conn->query($sql21);
            $Especialistas21 = null;
            if($query->num_rows>0){
            while ($r=$query->fetch_object()){
              $Especialistas21=$r;
              break;
            }
            
              }


              $sql22="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,
              Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja, Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.
              Nombre_Sucursal,Ventas_POS.FormaDePago, Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as VentaTotalCreditosGlobales
               FROM Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' 
               AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND Ventas_POS.FormaDePago!='Efectivo' AND Ventas_POS.FormaDePago!='Tarjeta' AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' ";
            $query = $conn->query($sql22);
            $Especialistas22 = null;
            if($query->num_rows>0){
            while ($r=$query->fetch_object()){
              $Especialistas22=$r;
              break;
            }
            
              }

              // Aqui es donde empieza la linea de codigos que generan las tablas que en teoria deberian ser dinamicas, sin embargo por peticion del departamento administrativo quedaron de forma unica y establecida
  
    $sql5="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja,
Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,
Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as totaldeservicios FROM
 Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID 
 AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC  AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' 
  GROUP by Servicios_POS.Servicio_ID";
$query = $conn->query($sql5);
// Aqui es donde se genera el codigo para la forma de pago como efectivo
$sql8="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,
Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja, Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.
Nombre_Sucursal,Ventas_POS.FormaDePago, Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as totalesdepagoEfectivo
 FROM Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' 
 AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND Ventas_POS.FormaDePago='Efectivo'AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' ";
$query8 = $conn->query($sql8);
// Aqui es donde se genera el codigo para la forma de pago como tarjeta
$sql88="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,
Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja, Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.
Nombre_Sucursal,Ventas_POS.FormaDePago, Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as totalesdepagotarjeta
 FROM Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' 
 AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND Ventas_POS.FormaDePago='Tarjeta'";
$query88 = $conn->query($sql88);
// Aqui es donde se genera el codigo para la forma de pago global de los Creditos 
$sql888="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,
Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja, Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.
Nombre_Sucursal,Ventas_POS.FormaDePago, Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as totalesdepagoCreditos
 FROM Ventas_POS,Servicios_POS,SucursalesCorre WHERE Fk_Caja = '".$_POST['id']."' 
 AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND Ventas_POS.FormaDePago!='Efectivo' AND Ventas_POS.FormaDePago!='Tarjeta' AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' ";
$query888 = $conn->query($sql888);

// Aqui es donde se genera el codigo para la forma de pago global de los abonos dentales


$sql8888="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta, Ventas_POS.AgregadoPor,Ventas_POS.Fk_Caja, 
Ventas_POS.AgregadoEl,Ventas_POS.FormaDePago,SUM(Ventas_POS.Importe) as totalesdepagoCreditosDentales FROM Ventas_POS WHERE Fk_Caja = '".$_POST['id']."' 
 AND Ventas_POS.Nombre_Prod='Abono de cr&eacute;dito'  ";
$query8888 = $conn->query($sql8888);

?>

<? if($Especialistas!=null):?>

  <form method="post" 
      target="print_popup" 
      action="http://localhost:8080/ticket/ArqueoDeCaja.php"
      onsubmit="window.open('about:blank','print_popup','width=900,height=900');"  id="GeneraTicketCierreCaja">
  <div style="display:none;">
      <input type="text" class="form-control "   readonly name="VendedorTicket"  readonly value="<?echo $row['Nombre_Apellidos']?>">
      <input type="number" class="form-control "  step="any" name="TotalCajaTicket" id="resultadototalventasTicket" readonly   aria-describedby="basic-addon1" >
      <input type="text" class="form-control " id="ticketiniciall" name="TicketInicialTicket"  readonly value="<? echo $Especialistas->Folio_Ticket; ?>">
      <input type="text" class="form-control " id="ticketfinall" name="TicketFinalTicket" readonly value="<? echo $Especialistas2->Folio_Ticket; ?>" aria-describedby="basic-addon1" maxlength="60">            
      <input type="text" class="form-control "  name="TotalTicketsTickets"readonly value="<? echo $Especialistas3->Total_tickets; ?>" aria-describedby="basic-addon1" maxlength="60">            
      <input type="number" class="form-control "  id="cantidadtotalventas" name="VentaTotal" step="any" readonly value="<? echo $Especialistas3->VentaTotal; ?>" aria-describedby="basic-addon1" >
      <input type="number" class="form-control "  id="cantidadtotalventas" name="totalSignosvitales" step="any" readonly value="<? echo $Especialistas3->Total_Folios; ?>" aria-describedby="basic-addon1" > 
      <input type="datetime" name="Horadeimpresiondelticket" value="<? echo date('h:i A', strtotime(($Especialistas13->Hora_Cierre))); ?>">
      <input type="datetime" name="Horadeimpresiondelticketcierre" value="<?php echo date('h:i:s A');?>">
      <input type="datetime" name="FechaDelCorte"  value="<? echo date('Y-m-d',strtotime(($Especialistas13->Hora_Cierre))); ?>">
      <input type="text" class="form-control" name="Sucursal" readonly  value="<?echo $row['Nombre_Sucursal']?>" aria-describedby="basic-addon1" >   
      <input type="number" class="form-control "  step="any" name="Totaldentales"  readonly   value="<? echo $Especialistas4->totaldentalescreditos; ?>" aria-describedby="basic-addon1" >
      <input type="text" class="form-control "   name="TotalCreditoEnfermeria"  readonly value="<? echo $Especialistas6->VentaTotalCredito; ?>" aria-describedby="basic-addon1" >  
      <input type="text" class="form-control "   name="TotalCreditolimpieza"  readonly value="<? echo $Especialistas7->VentaTotalCreditoLimpieza; ?>" aria-describedby="basic-addon1" >  
      <input type="text" class="form-control "   name="TotalCreditoMedicos"  readonly value="<? echo $Especialistas12->VentaTotalCreditoMedicos; ?>" aria-describedby="basic-addon1" >  
      <input type="text" class="form-control "   name="TotalCreditoFarmaceutico"  readonly value="<? echo $Especialistas11->VentaTotalCreditoFarmaceutico; ?>" aria-describedby="basic-addon1" >  
      <input type="text" class="form-control "   name="TurnoCorteticket"  readonly value="<? echo $Especialistas3->Turno; ?>" aria-describedby="basic-addon1" >  

      <input type="text" class="form-control "   name="TotalDeEfectivo"  readonly value="<? echo $Especialistas20->VentaTotalDeEfectivo; ?>" aria-describedby="basic-addon1" >  
      <input type="text" class="form-control "   name="TotalDeTarjeta"  readonly value="<? echo $Especialistas21->VentaTotalTarjeta; ?>" aria-describedby="basic-addon1" >  
      <input type="text" class="form-control "   name="TotalDeCreditos"  readonly value="<? echo $Especialistas22->VentaTotalCreditosGlobales; ?>" aria-describedby="basic-addon1" >  
      
      </div>

      <?php if($query->num_rows>0):?>
  <div class="text-center">
 
  <div class="row">
    <div class="col">
  <label for="exampleFormControlInput1">Sucursal</label>
  <input type="text" class="form-control "  id="cantidadtotalventas" name="TicketVentasTotl" step="any" readonly value="<? echo $Especialistas14->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" >
  </div>
  <div class="col">
  <label for="exampleFormControlInput1">Turno</label>
  <input type="text" class="form-control "  id="cantidadtotalventas" name="TicketVentasTotl" step="any" readonly value="<? echo $Especialistas3->Turno; ?>" aria-describedby="basic-addon1" >
  </div>  </div>
  <div class="row">
    <div class="col">
  <label for="exampleFormControlInput1">Cajero</label>
  <input type="text" class="form-control "  id="cantidadtotalventas" name="TicketVentasTotl" step="any" readonly value="<? echo $Especialistas3->AgregadoPor; ?>" aria-describedby="basic-addon1" >
  </div> 
  <div class="col">
  <label for="exampleFormControlInput1">Total de venta</label>
  <input type="number" class="form-control "  id="cantidadtotalventas" name="TicketVentasTotl" step="any" readonly value="<? echo $Especialistas3->VentaTotal; ?>" aria-describedby="basic-addon1" > 
  </div>  </div>
  <div class="row">
    <div class="col">
  <label for="exampleFormControlInput1">Total de tickets</label>
  <input type="text" class="form-control "  id="cantidadtotalventas" name="TicketVentasTotl" step="any" readonly value="<? echo $Especialistas3->Total_tickets; ?>" aria-describedby="basic-addon1" >
  </div> 
  <div class="col">
  <label for="exampleFormControlInput1">Total de signos vitales</label>
  <input type="number" class="form-control "  id="cantidadtotalventas" name="TicketVentasTotl" step="any" readonly value="<? echo $Especialistas3->Total_Folios; ?>" aria-describedby="basic-addon1" > 
  </div>  </div>
  
  <br>	<div class="table-responsive">
	<table  id="TotalesGeneralesCortes" class="table table-hover">
<thead>


<th>Nombre Servicio</th>

    <th>Total</th>
    
    
    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



  
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


<th>Forma de pago</th>

    <th>Total</th>
    <th>Forma de pago</th>

    <th>Total</th>
    <th>Forma de pago</th>

<th>Total</th>
    
    


</thead>
<?php while ($Usuarios2=$query8->fetch_array()):?>
  <?php while ($Usuarios3=$query88->fetch_array()):?>
    <?php while ($Usuarios4=$query888->fetch_array()):?>
<tr>
 


 
   
    <td> <input type="text" class="form-control "  name="NombreFormaPago[]"readonly value="<?php echo $Usuarios2["FormaDePago"]; ?>"></td>
    <td><input type="text" class="form-control "  name="TotalFormasPagos[]"readonly value="<?php echo $Usuarios2["totalesdepagoEfectivo"]; ?>"></td>
    <td> <input type="text" class="form-control "  name="NombreFormaPago[]"readonly value="<?php echo $Usuarios3["FormaDePago"]; ?>"></td>
    <td><input type="text" class="form-control "  name="TotalFormasPagos[]"readonly value="<?php echo $Usuarios3["totalesdepagotarjeta"]; ?>"></td>
    <td> <input type="text" class="form-control "  name="NombreFormaPago[]"readonly value="Creditos"></td>
    <td><input type="text" class="form-control "  name="TotalFormasPagos[]"readonly value="<?php echo $Usuarios4["totalesdepagoCreditos"]; ?>"></td>
		
</tr>
<?php endwhile;?><?php endwhile;?><?php endwhile;?>
</table>
</div>
</div>  

<div class="table-responsive">
	<table  id="TotalesGeneralesCortes" class="table table-hover">
<thead>


<th>Nombre Servicio</th>

    <th>Total</th>
    
    
    


</thead>
<?php while ($Usuarios12=$query8888->fetch_array()):?>
<tr>



  
    <td> <input type="text" class="form-control " readonly value="Abono dental "></td>
    <td><input type="text" class="form-control "  readonly value="<?php echo $Usuarios12["totalesdepagoCreditosDentales"]; ?>"></td>
   
    
		
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
</div>
      <button type="submit"  id="EnviaTicket"  class="btn btn-info">Enviar reimpresion <i class="fas fa-money-check-alt"></i></button>
      


<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>


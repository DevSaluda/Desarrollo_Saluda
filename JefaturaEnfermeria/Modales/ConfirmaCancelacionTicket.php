<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT DISTINCT Ventas_POS.Fk_Caja,Ventas_POS.Venta_POS_ID,Ventas_POS.Identificador_tipo,Ventas_POS.Folio_Ticket,Ventas_POS.Cod_Barra,Ventas_POS.Clave_adicional,
Ventas_POS.Nombre_Prod,Ventas_POS.Cantidad_Venta,Ventas_POS.Fk_sucursal,Ventas_POS.Motivo_Cancelacion,Ventas_POS.AgregadoPor,Ventas_POS.AgregadoEl,Ventas_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
Ventas_POS,SucursalesCorre WHERE Ventas_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' AND 
Ventas_POS.Folio_Ticket= ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>

<? if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="AutorizaLaCancelacionDeTicket" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio de fondo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="TicketFolioACancelar" readonly value="<? echo $Especialistas->Folio_Ticket; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

    
    <div class="form-group">
      
    <label for="exampleFormControlInput1">Motivo cancelacion <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="Text" class="form-control " name="ActCantidad" id="actcantidad" value="<? echo $Especialistas->Motivo_Cancelacion; ?>" aria-describedby="basic-addon1" >            
</div></div></div>

    </div>

<button type="submit"  id="submit"  class="btn btn-danger">Aplicar cancelacion <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/CancelaElTicket.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

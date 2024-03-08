<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Venta_POS_ID,Folio_Ticket,Motivo_Cancelacion,AgregadoPor,SUM(Total_Venta) as TotalTicket FROM Ventas_POS where Folio_Ticket = ".$_POST["id"];
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

<div class="form-group">
    <label for="exampleFormControlInput1">Folio ticket</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->Folio_Ticket; ?>">
    </div>
    </div>
    <div class="form-group">
    <label for="exampleFormControlInput1">Vendedor<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly  value="<? echo $Especialistas->AgregadoPor; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>

   
    <div class="form-group">
    <label for="exampleFormControlInput1">Total de venta<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly  value="<? echo $Especialistas->TotalTicket; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>

<div class="form-group">
    <label for="exampleFormControlInput1">Motivo de cancelación<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <textarea class="form-control" id="exampleFormControlTextarea1" disabled readonly  rows="3"><? echo $Especialistas->Motivo_Cancelacion; ?></textarea>
            
</div></div>
</div>


   
                          


<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

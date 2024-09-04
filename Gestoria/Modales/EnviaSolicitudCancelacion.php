<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT * FROM `Ventas_POS` WHERE Venta_POS_ID= ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="LeSolicitudCancelacion" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio de ticket</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " id="numberTicket" name="NumberTicket" readonly value="<? echo $Especialistas->Folio_Ticket; ?>">
    </div>
    </div>
    
    <div class="form-group">
    <label for="exampleFormControlInput1">Motivo cancelacion</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <textarea class="form-control" id="motivocancela" name="MotivoCancela" rows="3"></textarea>
    </div>
    </div>
<input type="text" class="form-control " hidden  id="fk_Caja" name="FK_CAJA"value="<? echo $Especialistas->Fk_Caja; ?>">
<input type="text" class="form-control " hidden id="Fk_Sucursal" name="FK_SUCURSAL" value="<? echo $Especialistas->Fk_sucursal; ?>">

    <input type="text" class="form-control " hidden  readonly id="actusuarioSc" name="UsuarioSC" readonly value="<?echo $row['Nombre_Apellidos']?>">

<button type="submit"  id="submit"  class="btn btn-info">Enviar <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/SolicitaCancelacionTickets.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

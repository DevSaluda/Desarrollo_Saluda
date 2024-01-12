<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
include "../Consultas/ConsultaCaja.php";
include "../Consultas/SumadeFolioTickets.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Creditos_Clinicas_POS.Folio_Credito,Creditos_Clinicas_POS.Fk_tipo_Credi,Creditos_Clinicas_POS.Nombre_Cred,
Creditos_Clinicas_POS.Fecha_Inicio,Creditos_Clinicas_POS.Fk_Sucursal,Creditos_Clinicas_POS.Estatus,Creditos_Clinicas_POS.CodigoEstatus,
Creditos_Clinicas_POS.ID_H_O_D,Creditos_Clinicas_POS.Saldo, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
Creditos_Clinicas_POS,SucursalesCorre where Creditos_Clinicas_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC and Creditos_Clinicas_POS.ID_H_O_D ='".$row['ID_H_O_D']."'
AND Creditos_Clinicas_POS.Fk_Sucursal ='".$row['Fk_Sucursal']."' AND 
Creditos_Clinicas_POS.Folio_Credito = ".$_POST["id"];
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
  




<form action="javascript:void(0)" method="post" id="FinalizaCreditoC" >

<div class="form-group">
    <label for="exampleFormControlInput1">Titular </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly  readonly  value="<? echo $Especialistas->Nombre_Cred; ?>" aria-describedby="basic-addon1" maxlength="60">            

    </div>
    </div>
    
   
   
    <div class="form-group">
    
    <div class="col">
    <label for="exampleFormControlInput1">Saldo total<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly  id="saldototal" readonly value="<? echo $Especialistas->Saldo; ?>" aria-describedby="basic-addon1" maxlength="60">  
  
    </div>
    <label for="abono" class="error"> 
  </div>
 
<!-- PRIMERA TANDA -->


  
<input type="text" class="form-control " hidden id="foliof" name="FolioF"  readonly value="<? echo $Especialistas->Folio_Credito; ?>">
<input type="text" class="form-control " hidden  readonly name="EstatusCC" id="estatuscc"  readonly value="Finalizado">
<input type="text" class="form-control " hidden  readonly name="CodigoCC" id="codigocc"  readonly value="background-color: #2BBB1D !important;">

<button type="submit"  id="submit"  class="btn btn-primary">Finalizar <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/FinalizaCredEnfer.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>



<?php
if($ValorCaja["Estatus"] == 'Abierta'){

  echo '
  <script>
$(document).ready(function()
{
// id de nuestro modal

$("#submit").attr("disabled", false);
});
</script>
  ';
     }else{
    
      echo '
      <script>
$(document).ready(function()
{
  // id de nuestro modal

  $("#submit").attr("disabled", true);
});
</script>
      ';
      
      
    
     } ?>
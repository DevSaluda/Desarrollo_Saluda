<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
include "../Consultas/ConsultaCaja.php";
include "../Consultas/SumadeFolioTickets.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT ReimpresionesTickets_CreditosDentales.ID_Reimpresion,ReimpresionesTickets_CreditosDentales.Fk_Folio_Credito,
 ReimpresionesTickets_CreditosDentales.Folio_Ticket,ReimpresionesTickets_CreditosDentales.Fk_tipo_Credi,
 ReimpresionesTickets_CreditosDentales.Nombre_Cred,ReimpresionesTickets_CreditosDentales.SaldoAnterior,ReimpresionesTickets_CreditosDentales.Cant_Abono, 
 ReimpresionesTickets_CreditosDentales.Saldo,ReimpresionesTickets_CreditosDentales.Fk_Sucursal,ReimpresionesTickets_CreditosDentales.Validez, 
 ReimpresionesTickets_CreditosDentales.Agrega,ReimpresionesTickets_CreditosDentales.Pagoen,ReimpresionesTickets_CreditosDentales.AgregadoEl, 
 ReimpresionesTickets_CreditosDentales.Sistema,ReimpresionesTickets_CreditosDentales.ID_H_O_D, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
 FROM ReimpresionesTickets_CreditosDentales, SucursalesCorre where ReimpresionesTickets_CreditosDentales.Fk_Sucursal= SucursalesCorre.ID_SucursalC AND
 ReimpresionesTickets_CreditosDentales.Fk_Folio_Credito = ".$_POST["id"];
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

  <p id="Espera" class="heading">ESPERE UN MOMENTO</p>

  <i id="Impresora" class="fas fa-print fa-4x " ></i>

        
        <br> <br>
                <p>GENERANDO IMPRESION</p>

  <form method="post" 
      target="print_popup" 
      action="http://localhost:8080/ticket/ReimpresionTicketAbono.php/"
      onsubmit="window.open('about:blank','print_popup','width=400,height=400');"  id="GeneraTicket">

      <input type="number" class="form-control "  hidden name="NumeroTicket" value="<?php echo $Especialistas->Folio_Ticket; ?>"readonly  >
      <input type="text" class="form-control "  hidden  name="FolioCredito"  readonly value="<? echo $Especialistas->Fk_Folio_Credito; ?>">
      <input type="text" class="form-control "  hidden  name="TramientoTicket" readonly value="<? echo $Especialistas->Fk_tipo_Credi; ?>" aria-describedby="basic-addon1" maxlength="60"> 
      <input type="number" class="form-control "   hidden name="AbonoTicket" id="abonoticket" value="<? echo $Especialistas->Cant_Abono; ?>" readonly   aria-describedby="basic-addon1" maxlength="60">  
      <input type="number" class="form-control "   hidden name="SaldoTicket" id="saldoticket" value="<? echo $Especialistas->Saldo; ?>" readonly   aria-describedby="basic-addon1" maxlength="60">  
      <input type="text" class="form-control "  hidden  readonly name="TitularCredito" value="<? echo $Especialistas->Nombre_Cred; ?>" aria-describedby="basic-addon1" maxlength="60"> 
      <input type="text" class="form-control "   hidden  readonly name="VendedorTicket"  readonly value="<? echo $Especialistas->Agrega; ?>">
      <input type="text" class="form-control "   hidden readonly name="SaldoActualTicket" value="<? echo $Especialistas->SaldoAnterior; ?>" aria-describedby="basic-addon1" maxlength="60">   
      <input type="text" class="form-control "  hidden readonly name="FechaValidez" value="<? echo $Especialistas->Validez; ?>" aria-describedby="basic-addon1" maxlength="60">   
      <input type="datetime" name="Horadeimpresion"  hidden value="<?echo date('h:i A', strtotime($Especialistas->AgregadoEl));?>">
      <button type="submit"  id="EnviaTicket"  hidden class="btn btn-info">Realizar abono <i class="fas fa-money-check-alt"></i></button>
</form>




<script src="js/Reimpresion.js"></script>
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>


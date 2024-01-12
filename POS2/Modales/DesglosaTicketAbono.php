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
ReimpresionesTickets_CreditosDentales.Folio_Ticket = ".$_POST["id"];
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
  
         <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">N° Ticket <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Folio_Ticket; ?>" >
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Tratamiento </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Fk_tipo_Credi; ?>">            
</div><label for="clav" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Titular<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Nombre_Cred; ?>" >          
    </div><label for="nombreprod" class="error">
    </div>
</div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Saldo anterior <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->SaldoAnterior; ?>" >
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Abono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Cant_Abono; ?>">            
</div><label for="clav" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Saldo<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
  </div>
  <input type="text" class="form-control " id="asignanombreprod" name="AsignaNombreProd" value="<? echo $Especialistas->Saldo; ?>" >          
    </div><label for="nombreprod" class="error">
    </div>
</div>
  
    
   

  

       </div>

       <!--Footer-->
      
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

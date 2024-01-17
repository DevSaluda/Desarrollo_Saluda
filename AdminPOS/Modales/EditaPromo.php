<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$user_id=null;
$sql1= "SELECT Promos_Credit_POS.ID_Promo_Cred,Promos_Credit_POS.Nombre_Promo,
Promos_Credit_POS.CantidadADescontar, Promos_Credit_POS.Fk_Tratamiento,
Promos_Credit_POS.Estatus,Promos_Credit_POS.CodigoEstatus,Promos_Credit_POS.ID_H_O_D, 
Tipos_Credit_POS.ID_Tip_Cred,Tipos_Credit_POS.Nombre_Tip FROM Promos_Credit_POS,Tipos_Credit_POS where 
Promos_Credit_POS.Fk_Tratamiento = Tipos_Credit_POS.ID_Tip_Cred AND Promos_Credit_POS.ID_Promo_Cred= ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>

<?php if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="EditaPromosAct" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio de promo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->ID_Promo_Cred; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre tratamiento<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<?php echo $Especialistas->Nombre_Tip; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

<div class="form-group">
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  name="ActCostoProm" id="actcostoprom" value="<?php echo $Especialistas->CantidadADescontar; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="VigenciaProm" class="form-control" id="vigenciaProm" onchange="TipoVigenciaProm();">
                 
                    
                   <option  value="<?php echo $Especialistas->CodigoEstatus; ?>"><? echo $Especialistas->Estatus; ?></option>		
              <option  value="background-color: #2BBB1D !important;">Vigente</option>		
              <option  value="background-color: #FE0000 !important;">Descontinuado</option>						  	
              				  				  
             </select>
    </div>
    </div>
    <div class="col">
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus actual</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
<button id="VigenciaPromBDPromo" class="btn btn-default btn-sm" style=<?php echo $Especialistas->CodigoEstatus; ?>><? echo $Especialistas->Estatus; ?></button> 
     <button id="SiVigentePromo" class="divOculto btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
      <button id="NoVigentePromo" class="divOculto btn btn-default btn-sm" style="background-color: #FE0000 !important;">Descontinuado</button>
    
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
    
<input type="text" class="form-control " hidden  readonly name="UsuarioPromo" id="usuariopromo"  readonly value="<?php echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistemapromo" name="SistemaPromo" readonly value="POS <?php echo $row['Nombre_rol']?>">

    <input type="text"  class="form-control " hidden readonly name="VigenciaPromEst" id="vigenciaPromest">
<input type="hidden" name="idpromo" id="idpromo" value="<?php echo $Especialistas->ID_Promo_Cred; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaPromociones.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
<script type="text/javascript">
  

  function TipoVigenciaProm() {


/* Para obtener el texto */
var combo = document.getElementById("vigenciaProm");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaPromest").val(selected);
}


$(function() {
  
    
$("#vigenciaProm").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color: #2BBB1D !important;":
        $("#SiVigentePromo").show();
                        
                        $("#NoVigentePromo").hide();
                        $("#Quizasproximo").hide();   
                        $("#VigenciaPromBDPromo").hide(); 
     
      break;

    case "background-color: #FE0000 !important;":
        $("#NoVigentePromo").show();

        $("#SiVigentePromo").hide();
        $("#Quizasproximo").hide();    
        $("#VigenciaPromBDPromo").hide();
      
      break;
      case "background-color: #ECB442 !important;":
        $("#Quizasproximo").show();    
        $("#NoVigentePromo").hide();
        $("#SiVigentePromo").hide();
        $("#VigenciaPromBDPromo").hide();
     
      
      break;
      case "":
        $("#NoVigentePromo").hide();
        $("#Quizasproximo").hide();    
        $("#SiVigentePromo").hide();
        $("#VigenciaPromBDPromo").hide();
        
     
      
      break;
      case "<?php echo $Especialistas->CodigoEstatus; ?>":
  
        $("#VigenciaPromBDPromo").show();
        $("#NoVigentePromo").hide();
        $("#Quizasproximo").hide();    
        $("#SiVigentePromo").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOculto {
			display: none;
		}
</style>
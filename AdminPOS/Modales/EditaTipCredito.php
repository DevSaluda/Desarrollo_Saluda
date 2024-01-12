<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT * FROM Tipos_Credit_POS WHERE ID_H_O_D='".$row['ID_H_O_D']."' AND ID_Tip_Cred = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="EditaTipoCreditos" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio de fondo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->ID_Tip_Cred; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre crédito<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  name="ActCrediNom" id="actcredinom" value="<? echo $Especialistas->Nombre_Tip; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

<div class="form-group">
    <label for="exampleFormControlInput1">Costo<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  name="ActCosto" id="actcosto" value="<? echo $Especialistas->Costo; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="Vigencia" class="form-control" id="vigencia" onchange="TipoVigencia();">
                 
                    
                   <option  value="<? echo $Especialistas->CodigoEstatus; ?>"><? echo $Especialistas->Estatus; ?></option>		
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
<button id="VigenciaBD" class="btn btn-default btn-sm" style=<? echo $Especialistas->CodigoEstatus; ?>><? echo $Especialistas->Estatus; ?></button> 
     <button id="SiVigente" class="divOculto btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
      <button id="NoVigente" class="divOculto btn btn-default btn-sm" style="background-color: #FE0000 !important;">Descontinuado</button>
    
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
    
<input type="text" class="form-control " hidden  readonly name="Usuario" id="usuario"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistema" name="Sistema" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresa" name="Empresa" readonly value="<?echo $row['ID_H_O_D']?>">
    <input type="text"  class="form-control " hidden readonly name="VigenciaEst" id="vigenciaest">
<input type="hidden" name="id" id="id" value="<?php echo $Especialistas->ID_Tip_Cred; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaTipoCreditos.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script type="text/javascript">
  

  function TipoVigencia() {


/* Para obtener el texto */
var combo = document.getElementById("vigencia");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaest").val(selected);
}


$(function() {
  
    
$("#vigencia").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color: #2BBB1D !important;":
        $("#SiVigente").show();
                        
                        $("#NoVigente").hide();
                        $("#Quizasproximo").hide();   
                        $("#VigenciaBD").hide(); 
     
      break;

    case "background-color: #FE0000 !important;":
        $("#NoVigente").show();

        $("#SiVigente").hide();
        $("#Quizasproximo").hide();    
        $("#VigenciaBD").hide();
      
      break;
      case "background-color: #ECB442 !important;":
        $("#Quizasproximo").show();    
        $("#NoVigente").hide();
        $("#SiVigente").hide();
        $("#VigenciaBD").hide();
     
      
      break;
      case "":
        $("#NoVigente").hide();
        $("#Quizasproximo").hide();    
        $("#SiVigente").hide();
        $("#VigenciaBD").hide();
        
     
      
      break;
      case "<? echo $Especialistas->CodigoEstatus; ?>":
  
        $("#VigenciaBD").show();
        $("#NoVigente").hide();
        $("#Quizasproximo").hide();    
        $("#SiVigente").hide();
       
     
      
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
<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT * FROM TipProd_POS WHERE ID_H_O_D ='".$row['ID_H_O_D']."' AND Tip_Prod_ID = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="ActualizaTipoProd" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->Tip_Prod_ID; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre de categoria<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  id="actnomttp" name="ActNomTTP" value="<? echo $Especialistas->Nom_Tipo_Prod; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

    
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus fondo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="ActVigenciaCat" class="form-control" id="actualizavigenciacatTTP" onchange="ActualizaTipoProdVigencia();">
                 
                    
                   <option  value="<? echo $Especialistas->Cod_Estado; ?>"><? echo $Especialistas->Estado; ?></option>		
              <option  value="background-color:#2BBB1D!important;">Vigente</option>		
              <option  value="background-color:#828681!important;">Descontinuado</option>						  	
             				  				  
             </select>
    </div>
    </div>
    <div class="col">
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus fondo</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
<button id="VigenciaBDTipoProd" class="btn btn-default btn-sm" style=<? echo $Especialistas->Cod_Estado; ?>><? echo $Especialistas->Estado; ?></button> 
     <button id="SiVigenteCatAct" class="divOcultoCatAct btn btn-default btn-sm" style="background-color:#2BBB1D!important;">Vigente</button> 
      <button id="NoVigenteCatAct" class="divOcultoCatAct btn btn-default btn-sm" style="background-color:#828681!important;">Descontinuado</button>
      <button id="QuizasproximoCatAct" class="divOcultoCatAct btn btn-default btn-sm" style="background-color:#ff6c0c!important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
    <input type="text"  class="form-control " hidden readonly name="ActVigEstTTP" id="vigenciacatactTTP">
    <input type="text" class="form-control " hidden  readonly id="actusuariottp" name="ActUsuarioTTP" readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="actsistemattp" name="ActSistemaTTP" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="hidden" name="Id_TTP" id="id" value="<?php echo $Especialistas->Tip_Prod_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaTTP.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script type="text/javascript">
  

  function ActualizaTipoProdVigencia() {


/* Para obtener el texto */
var combo = document.getElementById("actualizavigenciacatTTP");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciacatactTTP").val(selected);
}


$(function() {
  
    
$("#actualizavigenciacatTTP").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigenteCatAct").show();
                        
                        $("#NoVigenteCatAct").hide();
                        $("#QuizasproximoCatAct").hide();   
                        $("#VigenciaBDTipoProd").hide(); 
     
      break;

    case "background-color:#828681!important;":
        $("#NoVigenteCatAct").show();

        $("#SiVigenteCatAct").hide();
        $("#QuizasproximoCatAct").hide();    
        $("#VigenciaBDTipoProd").hide();
      
      break;
      case "background-color:#ff6c0c!important;":
        $("#QuizasproximoCatAct").show();    
        $("#NoVigenteCatAct").hide();
        $("#SiVigenteCatAct").hide();
        $("#VigenciaBDTipoProd").hide();
     
      
      break;
      case "":
        $("#NoVigenteCatAct").hide();
        $("#QuizasproximoCatAct").hide();    
        $("#SiVigenteCatAct").hide();
        $("#VigenciaBDTipoProd").hide();
        
     
      
      break;
      case "<? echo $Especialistas->Cod_Estado; ?>":
  
        $("#VigenciaBDTipoProd").show();
        $("#NoVigenteCatAct").hide();
        $("#QuizasproximoCatAct").hide();    
        $("#SiVigenteCatAct").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoCatAct {
			display: none;
		}
</style>
<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$user_id=null;
$sql1= "SELECT * FROM Marcas_POS WHERE ID_H_O_D ='".$row['ID_H_O_D']."' AND Marca_ID = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="ActualizaMarcas" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->Marca_ID; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre de Marca<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  id="actnomMar" name="ActNomMar" value="<?php echo $Especialistas->Nom_Marca; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

    
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus fondo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
  </div>
  <select name="ActVigenciaMar" class="form-control" id="actualizavigenciaMar" onchange="ActualizaTipoVigenciaM();">
                 
                    
                   <option  value="<?php echo $Especialistas->Cod_Estado; ?>"><?php echo $Especialistas->Estado; ?></option>		
              <option  value="background-color:#2BBB1D!important;">Vigente</option>		
              <option  value="background-color:#828681!important;">Descontinuado</option>						  	
              <option  value="background-color:#ff6c0c!important;">Proximamente</option>						  				  
             </select>
    </div>
    </div>
    <div class="col">
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus marca</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
<button id="VigenciaBDMar" class="btn btn-default btn-sm" style=<? echo $Especialistas->Cod_Estado; ?>><?php echo $Especialistas->Estado; ?></button> 
     <button id="SiVigenteMarAct" class="divOcultoMarAct btn btn-default btn-sm" style="background-color:#2BBB1D!important;">Vigente</button> 
      <button id="NoVigenteMarAct" class="divOcultoMarAct btn btn-default btn-sm" style="background-color:#828681!important;">Descontinuado</button>
      <button id="QuizasproximoMarAct" class="divOcultoMarAct btn btn-default btn-sm" style="background-color:#ff6c0c!important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
    <input type="text"  class="form-control " hidden readonly name="ActVigEstM" id="vigenciaMaract">
    <input type="text" class="form-control " hidden  readonly id="actusuariom" name="ActUsuarioM" readonly value="<?php echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="actsistemam" name="ActSistemaM" readonly value="POS <?php echo $row['Nombre_rol']?>">
<input type="hidden" name="Id_Mar_Act" id="id" value="<?php echo $Especialistas->Marca_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaMarca.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
<script type="text/javascript">
  

  function ActualizaTipoVigenciaM() {


/* Para obtener el texto */
var combo = document.getElementById("actualizavigenciaMar");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaMaract").val(selected);
}


$(function() {
  
    
$("#actualizavigenciaMar").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigenteMarAct").show();
                        
                        $("#NoVigenteMarAct").hide();
                        $("#QuizasproximoMarAct").hide();   
                        $("#VigenciaBDMar").hide(); 
     
      break;

    case "background-color:#828681!important;":
        $("#NoVigenteMarAct").show();

        $("#SiVigenteMarAct").hide();
        $("#QuizasproximoMarAct").hide();    
        $("#VigenciaBDMar").hide();
      
      break;
      case "background-color:#ff6c0c!important;":
        $("#QuizasproximoMarAct").show();    
        $("#NoVigenteMarAct").hide();
        $("#SiVigenteMarAct").hide();
        $("#VigenciaBDMar").hide();
     
      
      break;
      case "":
        $("#NoVigenteMarAct").hide();
        $("#QuizasproximoMarAct").hide();    
        $("#SiVigenteMarAct").hide();
        $("#VigenciaBDMar").hide();
        
     
      
      break;
      case "<?php echo $Especialistas->Cod_Estado; ?>":
  
        $("#VigenciaBDMar").show();
        $("#NoVigenteMarAct").hide();
        $("#QuizasproximoMarAct").hide();    
        $("#SiVigenteMarAct").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoMarAct {
			display: none;
		}
</style>
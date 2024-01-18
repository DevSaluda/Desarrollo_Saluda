<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$user_id=null;
$sql1= "SELECT * FROM Categorias_POS WHERE ID_H_O_D ='".$row['ID_H_O_D']."' AND Cat_ID = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="ActualizaCategorias" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->Cat_ID; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre de categoría<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  id="actnomcat" name="ActNomCat" value="<?php echo $Especialistas->Nom_Cat; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

    
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Vigencia categoría</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"> <i class="fas fa-info-circle"></i></span>
  </div>
  <select name="ActVigenciaCat" class="form-control" id="actualizavigenciacat" onchange="ActualizaTipoVigencia();">
                 
                    
                   <option  value="<?php echo $Especialistas->Cod_Estado; ?>"><? echo $Especialistas->Estado; ?></option>		
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
       <th scope="col" style="background-color: #4285f4 !important;">Estatus fondo</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
<button id="VigenciaBD" class="btn btn-default btn-sm" style=<?php echo $Especialistas->Cod_Estado; ?>><?php echo $Especialistas->Estado; ?></button> 
     <button id="SiVigenteCatAct" class="divOcultoCatAct btn btn-default btn-sm" style="background-color:#2BBB1D!important;">Vigente</button> 
      <button id="NoVigenteCatAct" class="divOcultoCatAct btn btn-default btn-sm" style="background-color:#828681!important;">Descontinuado</button>
      <button id="QuizasproximoCatAct" class="divOcultoCatAct btn btn-default btn-sm" style="background-color:#ff6c0c!important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
    <input type="text"  class="form-control " hidden readonly name="ActVigEst" id="vigenciacatact">
    <input type="text" class="form-control " hidden  readonly id="actusuarioc" name="ActUsuarioC" readonly value="<?php echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="actsistemac" name="ActSistemaC" readonly value="POS <?php echo $row['Nombre_rol']?>">
<input type="hidden" name="Id_Cat_Act" id="id" value="<?php echo $Especialistas->Cat_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaCategoria.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
<script type="text/javascript">
  

  function ActualizaTipoVigencia() {


/* Para obtener el texto */
var combo = document.getElementById("actualizavigenciacat");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciacatact").val(selected);
}


$(function() {
  
    
$("#actualizavigenciacat").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigenteCatAct").show();
                        
                        $("#NoVigenteCatAct").hide();
                        $("#QuizasproximoCatAct").hide();   
                        $("#VigenciaBD").hide(); 
     
      break;

    case "background-color:#828681!important;":
        $("#NoVigenteCatAct").show();

        $("#SiVigenteCatAct").hide();
        $("#QuizasproximoCatAct").hide();    
        $("#VigenciaBD").hide();
      
      break;
      case "background-color:#ff6c0c!important;":
        $("#QuizasproximoCatAct").show();    
        $("#NoVigenteCatAct").hide();
        $("#SiVigenteCatAct").hide();
        $("#VigenciaBD").hide();
     
      
      break;
      case "":
        $("#NoVigenteCatAct").hide();
        $("#QuizasproximoCatAct").hide();    
        $("#SiVigenteCatAct").hide();
        $("#VigenciaBD").hide();
        
     
      
      break;
      case "<?php echo $Especialistas->Cod_Estado; ?>":
  
        $("#VigenciaBD").show();
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
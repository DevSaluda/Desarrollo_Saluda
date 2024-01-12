 
      <div class="modal fade bd-example-modal-xl" id="AperturaCredit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      
  <div class="modal-dialog modal-xl modal-notify modal-success">
    <div class="modal-content">
    

    <div class="modal-header">
         <p class="heading lead">Apertura de credito</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
        <div class="modal-body">
         <div class="text-center">
 
 <form action="javascript:void(0)" method="post" id="AbreCredito">
 <!-- PRIMERA TANDA INICIO -->
 <div class="form-row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre y apellidos <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input  type="text" id="nombres" name="Nombres" class="form-control">
    </div>
    <label for="tipocred" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Edad</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar-alt"></i></span>
  </div>
  <input  type="text" id="edad" name="Edad" class="form-control">
    </div>
   <div>
   <label for="cap" class="error">
    </div>
   </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Sexo<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <select id = "sexo" class = "form-control" name = "Sexo" >
                                               <option value="">Seleccione un sexo:</option>
                                               <option value="Masculino">Masculino</option>
                                               <option value="Femenino">Femenino</option>
          </select>      
</div>
<label for="nombres" class="error">
    </div>
    </div>

<!-- TERCERA TANDA FIN -->


  
 
  
    <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Direccion </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar-alt"></i></span>
  </div>
  <input  type="text" id="direccion" name="Direccion" class="form-control">
    </div>
   <div>
   <label for="direccion" class="error">
    </div>
   </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Telefono </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-list-ol"></i></span>
  </div>
  <input type="number" class="form-control " name="Tel" id="tel"  type="text" size="30" maxlength="60">            
</div>
<label for="tel" class="error">
    </div>  
    <div class="col">
      
    <label for="exampleFormControlInput1">Area </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-list-ol"></i></span>
  </div>
  <select name="Area" id="area" class = "form-control"  >
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT ID_Area_Cred,Nombre_Area,ID_H_O_D FROM Areas_Credit_POS WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_Area_Cred].'">'.$valores[Nombre_Area].'</option>';
          }
        ?>  </select>  
              
</div>
<label for="promo" class="error">
    </div>  
    </div>


    
    <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-venus-mars"></i></span>
  </div>
  <input type="date" class="form-control " name="FechaI" id="fechai"  aria-describedby="basic-addon1" maxlength="60">         
 
    </div>
    <label for="fechai" class="error">
    </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Fecha de termino <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-allergies"></i></span>
  </div>
  <input type="date" class="form-control " name="FechaF" id="fechaf"  aria-describedby="basic-addon1" maxlength="60">            
</div>

<label for="fechaf" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">odontologo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar-alt"></i></span>
  </div>
  <select id="odo" name="Odo" class = "form-control"  >
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT ID_Med_Cred,Nombre_Med,ID_H_O_D FROM Medicos_Credit_POS WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_Med_Cred].'">'.$valores[Nombre_Med].'</option>';
          }
        ?>  </select>  
 
    </div>
   <div>
   <label for="odo" class="error">
    </div>
   </div>
    </div>
    <div>
    </div>
 <div class="form-row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Tratamiento <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select id = "tipocred" class = "form-control" name = "TipoCred" >
                                               <option value="">Seleccione un tratamiento:</option>
        <?
          $query = $conn -> query ("SELECT ID_Tip_Cred,Nombre_Tip,ID_H_O_D FROM Tipos_Credit_POS WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_Tip_Cred].'">'.$valores[Nombre_Tip].'</option>';
          }
        ?>  </select>        
    </div>
    <label for="tipocred" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Costo tratamiento</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar-alt"></i></span>
  </div>
  <select  id = "cap" name = "CAP"  class = "form-control" disabled = "disabled"  onchange="TipoVigencia();">
								<option value = "">Selecciona un costo</option>
							</select>
    </div>
   <div>
   <label for="cap" class="error">
    </div>
   </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text"  class="form-control " readonly value="<?echo $row['Nombre_Sucursal']?>">
  
</div>
<label for="nombres" class="error">
    </div>
    </div>

<!-- PRIMERA TANDA FIN -->





 <div class="form-row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Promocion <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select  id = "promocionva"   class = "form-control" disabled = "disabled" onchange="CapturaPromo();" >
								<option value = "">Selecciona una promocion</option>
							</select> 
    </div>
    <label for="tipocred" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Descuento aplicable</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar-alt"></i></span>
  </div>
  <select  id = "descuentova"   class = "form-control" disabled = "disabled" onchange="CostoDes();" >
								<option value = "">Descuento</option>
							</select>
    </div>
   <div>
   <label for="cap" class="error">
    </div>
   </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Costo total<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text"  class="form-control "   readonly name="CostoReal" id="costoreal">
</div>
<label for="nombres" class="error">
    </div>
    </div>

<!-- SEGUNDA TANDA FIN -->



   
    


    
    <input type="text" class="form-control" id="estatus" name="Estatus"  hidden  readonly value="Apertura" >
    <input type="text"  class="form-control " hidden readonly name="Costoo" id="costoo">
    <input type="text"  class="form-control "   hidden name="Descuento" id="descuentoooo">
    <input type="text"  class="form-control "   hidden  name="PromoReal" id="promoreal">
    <input type="text"  class="form-control " hidden  readonly name="Sucursal" id="sucursal" value="<?echo $row['Fk_Sucursal']?>">
    <input type="text" class="form-control" id="codestatus" name="CodEstatus"  hidden  readonly value="background-color: #2BBB1D !important;" >
  <input type="text" class="form-control" id="empresa" name="Empresa" hidden  readonly value="<? echo $row['ID_H_O_D']?>" >
  <input type="text" class="form-control" id="agenda" name="AgendaPor" hidden readonly   value="<?echo $row['Nombre_Apellidos']?>" >
  <input type="text" class="form-control" id="sistema" name="Sistema"  hidden  readonly value="POS <?echo $row['Nombre_rol']?>" >
  <div class="text-center">
  <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
  </div>
                                        </form>
     
</form>


    
      <p class="statusMsg"></p>

    
    </div>
  </div>
</div>  </div>
</div></div>  </div>
</div>
<script>
      
      
        
    </script>
<script type="text/javascript">
  
  function CapturaPromo() {
    var combo = document.getElementById("promocionva");

var selected = combo.options[combo.selectedIndex].text;
$("#promoreal").val(selected);
  
  }
  function TipoVigencia() {


/* Para obtener el texto */
var combo = document.getElementById("cap");

var selected = combo.options[combo.selectedIndex].text;
$("#costoo").val(selected);
$("#costoreal").val(selected);
}

function CostoDes() {


/* Para obtener el texto */
var combo = document.getElementById("descuentova");

var selected = combo.options[combo.selectedIndex].text;
$("#descuentoooo").val(selected);
var precio1 = document.getElementById("costoo")
       var precio2 = document.getElementById("descuentoooo")
       var precio3 = document.getElementById("costoreal")
      
            precio3.value = parseFloat(precio1.value) - parseFloat(precio2.value)
  document.getElementById("resultado").value = total.toFixed(2);
       
}



</script>

<?php
if($ValorCaja["Estatus"] == 'Abierta'){

  echo '
  <script>
$(document).ready(function()
{
// id de nuestro modal

$("#submit_registro").attr("disabled", false);
});
</script>
  ';
     }else{
    
      echo '
      <script>
$(document).ready(function()
{
  // id de nuestro modal

  $("#submit_registro").attr("disabled", true);
});
</script>
      ';
      
      
    
     } ?>
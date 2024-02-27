
  
      <div class="modal fade bd-example-modal-xl" id="AltaSucursal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Alta de sucursal para campañas medicas</p>

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
     
 <form action="javascript:void(0)" method="post" id="AgregaSucursal">
    
 <div id="ValidaSucursal"></div>
<label for="exampleFormControlInput1">Sucursal <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-clinic-medical"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal" onchange="NameSucursal()">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $mysqli -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
         
</div>
<label for="sucursal" class="error">
</div>
<input type="text" class="form-control" id="nsucursal" readonly hidden name="NSucursal"  >

<input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<? echo $row['ID_H_O_D']?>" >
<input type="text" class="form-control" id="usuario" name="Usuario" hidden  value="<? echo $row['Nombre_Apellidos']?>" >
           
         <div>      
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>

<script type="text/javascript">
function NameSucursal()
{

 
/* Para obtener el texto */
var combo = document.getElementById("sucursal");
var selected = combo.options[combo.selectedIndex].text;
$("#nsucursal").val(selected);
}

</script>

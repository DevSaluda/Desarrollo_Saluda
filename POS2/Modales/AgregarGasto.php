
  
      <div class="modal fade bd-example-modal-xl" id="AltaGastoCat" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nuevo tipo de crédito <i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold"><?echo $row['Nombre_Apellidos']?>, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
     
 <form action="javascript:void(0)" method="post" id="AgregarGastoDeSucursal">
    
 
    
  
    
    
      
    <label for="exampleFormControlInput1">Nombre de concepto o categoría <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <select id = "conceptogasto" class = "form-control" name = "ConceptoGasto" >
                                               <option value="">Selecciona un concepto o categoría:</option>
        <?
          $query = $conn -> query ("SELECT Cat_Gasto_ID,Nom_Cat_Gasto,ID_H_O_D,Estado FROM Categorias_Gastos_POS WHERE Estado='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Cat_Gasto_ID].'">'.$valores[Nom_Cat_Gasto].'</option>';
          }
        ?>  </select>
</div>
    
      
<label for="exampleFormControlInput1">Importe total <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  
  <input type="number" step="any" class="form-control " id="importe" name="Importe" placeholder="00.00" aria-describedby="basic-addon1" maxlength="60">            
</div>

<label for="exampleFormControlInput1">Descripcion <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  
  <textarea class="form-control" id="descripcion" name="Descripcion" rows="3"></textarea>           
</div>
    

<input type="text" class="form-control " hidden readonly name="Usuario" id="usuario"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text"  class="form-control "  hidden readonly name="Sucursal" value="<?echo $row['Fk_Sucursal']?>">
<input type="text"  class="form-control "  hidden readonly name="Caja" value="<?php echo $ValorCaja["ID_Caja"];?>">
<input type="text" class="form-control "   hidden readonly id="sistema" name="Sistema" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresa" name="Empresa" readonly value="<?echo $row['ID_H_O_D']?>">
  <div>
   
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>

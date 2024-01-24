<!-- Central Modal Medium Info -->
<div class="modal fade" id="Altarol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true" style="overflow-y: scroll;">
   <div class="modal-dialog  modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Alta de nuevo rol/puesto</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <form enctype="multipart/form-data" id="AgregaEmpleados">
     

    
         <div class="form-group">
      
    <label for="exampleFormControlInput1">Nombre rol/puesto <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreRol" id="nombrerol" aria-describedby="basic-addon1" >            
</div><label for="file" class="error"></div></div>



<input type="text" class="form-control" hidden  name="Empresa" id="empresa"  readonly value="<?php echo $row['ID_H_O_D']?>">
    <input type="text" class="form-control"  hidden name="Agrega" id="agrega"  readonly value=" <?php echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="Sistema" id="sistema"  readonly value=" <?php echo $row['Nombre_rol']?>">
   

  

       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
         
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <!-- Central Modal Medium Info-->
 
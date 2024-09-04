
<?
include "Consultas/SumaOrdenesLaboratorio.php";?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="modal fade" id="CitaExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo">Agendamiento de laboratorios </p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
     
<form action="javascript:void(0)" method="post" id="AgendaExternoRevaloraciones" >

<div class="form-group">
    <label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-user"></i></span>
  </div>
  <input type="text" class="form-control"   name="NombrePaciente[]"  aria-describedby="basic-addon1">
 
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control"   name="Telefono[]"  aria-describedby="basic-addon1">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Fecha de cita</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar"></i></span>
  </div>
  <input type="date" class="form-control"   name="FechaCita[]" aria-describedby="basic-addon1">
</div>
    </div>
    <a href="javascript:void(0)" id="agregarmasproductos"class="btn btn-info addMore"> Agregar laboratorio <i class="fa-solid fa-plus"></i></a>

    
    </div>
   

          
    

<!-- INICIA DATA DE AGENDA -->


<div class="text-center">
    
   
            
    <div class="form-group fieldGroupCopy" style="display: none;">
            
            <div class="lista-producto float-clear" style="clear:both;">
            <ul class="list-group">
   <li class="list-group-item">
   <div class="form-row">
   
     
  
 
  
   <div class="col">  <label for="exampleFormControlInput1">Codigo de barra <span class="text-danger">*</span> </label>  <input class="form-control"  type="text" id="codbarra"  name="LabCod[]"  placeholder="Codigo de barra o nombre de producto"/></div>
   <div class="col">     <label for="exampleFormControlInput1">Nombre/Descripcion <span class="text-danger">*</span>   </label>   <input class="form-control" readonly type="text"  placeholder="Nombres"/></div>
   
   <div class="col"> <label for="exampleFormControlInput1">Precio de venta <span class="text-danger">*</span>  </label>   <input class="input-precio form-control"   type="text"  placeholder="Cargo"/></div>
  
  
   <input type="text" class="form-control" name="Agendo[]"   value="<?echo $row['Nombre_Apellidos']?>"  hidden readonly >
  
  <input type="text" class="form-control" name="Sucursal[]"  value="<?echo $row['Fk_Sucursal']?>" hidden  readonly >

  <input type="text" class="form-control"   name="NumOrde[]"  value="<?php echo $totalmonto?>" aria-describedby="basic-addon1">
      
  </form>    
   <div class="col">   <label for="exampleFormControlInput1">Eliminar </label> <br> <a   id="deletee" class="btn btn-danger btn-sm remove"><i class="fas fa-minus-circle"></i></a></div></div>
              	</li>
 </ul>      
              </div> </div> 
              
            

    
   

    <div class="text-center">
<button type="submit"  name="submit_AgeExt" id="submit_AgeExt"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
    </div>    </div></div>
<!-- FINALIZA DATA DE AGENDA -->
                  
</form>
</div></div>


</div></div>

<style>
  .ui-front {
    position: absolute !important;
    z-index: 2006 !important;
    overflow: auto !important;
}
</style>


        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal --> 

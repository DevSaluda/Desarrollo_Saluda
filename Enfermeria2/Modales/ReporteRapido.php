<div class="modal fade bd-example-modal-xl" id="ReporteRapidoModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-="true">
      
      <div class="modal-dialog modal-notify modal-info">
        <div class="modal-content">
        
    
        <div class="modal-header">
             <p class="heading lead">Reporte rapido</p>
    
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-="true" class="white-text">&times;</span>
             </button>
           </div>
        
            <div class="modal-body">
             <div class="text-center">
     
     <form action="javascript:void(0)" method="post" id="ReporteExpress">
     <!-- PRIMERA TANDA INICIO -->
     
        <div class="form-group">
        <label for="exampleFormControlInput1">Describa el problema o incidencia presentado</label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-keyboard"></i></span>
      </div>
      <textarea class="form-control" id="reportedescribe" name="ReporteDescribe" rows="3"></textarea>
        </div>
      
       </div>
     
    
          
    

       
        
    
    
      
        
        <input type="text"  class="form-control "   readonly name="Sucursal" id="sucursal" hidden value="<?php echo $row['Fk_Sucursal']?>">
  
      <input type="text" class="form-control" id="empresa" name="Empresa"  hidden readonly value="<?php echo $row['ID_H_O_D']?>" >
      <input type="text" class="form-control" id="usuario" name="Usuario" hidden readonly   value="<?php echo $row['Nombre_Apellidos']?>" >
      <input type="text" class="form-control" id="sistema" name="Sistema"    hidden readonly value="<?php echo $row['Nombre_rol']?>" >
      
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
          
          
            
    
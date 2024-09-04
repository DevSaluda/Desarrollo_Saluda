
  
      <div class="modal fade bd-example-modal-xl" id="PonerVentaEnPausa" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Colocar venta en espera<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
     
<label for="exampleFormControlInput1">Importe total <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  
  <input type="number" step="any" class="form-control "readonly id="subtotal" >            
</div>



    


  <div>
 
      <button type="submit"   id="activoventa"  onClick="this.disabled='disabled'" disabled class="btn btn-success">Continuar <i class="fas fa-check-circle"></i></button> <br>
     
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  

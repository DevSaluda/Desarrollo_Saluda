
  
      <div class="modal fade bd-example-modal-sm" id="Descuento1detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>

  <select  id="cantidadadescontar" class="form-control "  onchange="aplicadescuento1()">
  <option value="">Seleccionar descuento</option> 
  <option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>
  </select>          
</div>







    


  <div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  
  <!-- INICIA DESCUENTO2 -->
  <div class="modal fade bd-example-modal-sm" id="Descuento2detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  
  
  <select class="form-control" id="cantidadadescontar2"  onchange="aplicadescuento2()">
  <option value="">Seleccionar descuento</option> 
  <option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>

  </select>          
</div>







    


  <div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
   <!-- FIN DESCUENTO2 -->
 <!-- INICIO DESCUENTO3 -->
   <div class="modal fade bd-example-modal-sm" id="Descuento3detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  

<select class="form-control " onchange="aplicadescuento3()"id="cantidadadescontar3">
<option value="">Seleccionar descuento</option> 
<option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>
  </select>    
</div>

<div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
    </div>
  </div>
  </div>
  </div>

  <!-- FIN DESCUENTO3 -->

  
  <!-- INICIO DESCUENTO4 -->
  <div class="modal fade bd-example-modal-sm" id="Descuento4detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  

<select class="form-control " onchange="aplicadescuento4()"id="cantidadadescontar4">
<option value="">Seleccionar descuento</option> 
<option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>
  </select>    
</div>

<div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
    </div>
  </div>
  </div>
  </div>
   <!-- FIN DESCUENTO4 -->


    
  <!-- INICIO DESCUENTO5 -->
  <div class="modal fade bd-example-modal-sm" id="Descuento5detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  

<select class="form-control " onchange="aplicadescuento5()"id="cantidadadescontar5">
<option value="">Seleccionar descuento</option> 
<option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>
  </select>    
</div>

<div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
    </div>
  </div>
  </div>
  </div>
   <!-- FIN DESCUENTO5 -->


       
  <!-- INICIO DESCUENTO6 -->
  <div class="modal fade bd-example-modal-sm" id="Descuento6detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  

<select class="form-control " onchange="aplicadescuento6()"id="cantidadadescontar6">
<option value="">Seleccionar descuento</option> 
<option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>
  </select>    
</div>

<div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
    </div>
  </div>
  </div>
  </div>
   <!-- FIN DESCUENTO6 -->


       
  <!-- INICIO DESCUENTO7 -->
  <div class="modal fade bd-example-modal-sm" id="Descuento7detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  

<select class="form-control " onchange="aplicadescuento7()"id="cantidadadescontar7">
<option value="">Seleccionar descuento</option> 
<option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>
  </select>    
</div>

<div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
    </div>
  </div>
  </div>
  </div>
   <!-- FIN DESCUENTO7 -->


   <!-- INICIO DESCUENTO8 -->
  <div class="modal fade bd-example-modal-sm" id="Descuento8detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  

<select class="form-control " onchange="aplicadescuento8()"id="cantidadadescontar8">
<option value="">Seleccionar descuento</option> 
<option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>
  </select>    
</div>

<div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
    </div>
  </div>
  </div>
  </div>
   <!-- FIN DESCUENTO8 -->


   <!-- INICIO DESCUENTO9 -->
  <div class="modal fade bd-example-modal-sm" id="Descuento9detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  

<select class="form-control " onchange="aplicadescuento9()"id="cantidadadescontar7">
<option value="">Seleccionar descuento</option> 
<option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>
  </select>    
</div>

<div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
    </div>
  </div>
  </div>
  </div>
   <!-- FIN DESCUENTO9 -->

   <!-- INICIO DESCUENTO10 -->
  <div class="modal fade bd-example-modal-sm" id="Descuento10detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Aplicar descuentos<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
      
<label for="exampleFormControlInput1">% a descontar <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  

<select class="form-control " onchange="aplicadescuento10()"id="cantidadadescontar10">
<option value="">Seleccionar descuento</option> 
<option value="5">5%</option>
  <option value="10">10%</option>
  <option value="15">15%</option>
  <option value="20">20%</option>
  <option value="25">25%</option>
  <option value="30">30%</option>
  <option value="35">35%</option>
  <option value="40">40%</option>
  <option value="45">45%</option>
  <option value="50">50%</option>
  </select>    
</div>

<div>
   
      <button onclick="sumar()"  data-dismiss="modal" class="btn btn-success">Aceptar <i class="fas fa-check-circle"></i></button>
                                        </form>
                                        </div>
                                        </div>
    </div>
  </div>
  </div>
  </div>
   <!-- FIN DESCUENTO10 -->
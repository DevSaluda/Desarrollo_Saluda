
<div class="modal fade" id="GeneradorReporteEnergia" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog  modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo">Generador de reporte de consumo de energía</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
   
	        <div class="modal-body">
          <div class="text-center">
          <form action="ReporteDeConsumoEnergia.php" target="blank_" method="post"  >


<div class="text-center" >

<div class="form-group">
    <label for="exampleFormControlInput1">Fecha inicio</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-calendar-day"></i></span>
  </div>
  <input type="date" name="FechaInicial" id="" class="form-control">
</div>
</div>
    <div class="form-group">
    <label for="exampleFormControlInput1">Fecha fin</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-calendar-minus"></i></span>
  </div>
  <input type="date" name="FechaFinal" id="" class="form-control">
</div>

</div>
  
 

    
<button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Generar Reporte <i class="fas fa-file-import"></i></button>
</div>                    
</form>
    
 
  
<!-- INICIA DATA DE AGENDA -->


   
    



</div></div>




        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
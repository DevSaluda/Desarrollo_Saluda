<div class="modal fade bd-example-modal-xl" id="PedidoPorPeriodo" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
      
      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Generando ordenes de pedido<i class="fas fa-credit-card ml-2"></i></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="icon-container mb-4">
            <i class="fas fa-store fa-5x animated bounceIn"></i>
          </div>
          
          <form action="PrePedidoPorDia" method="post" >
            
            
            
            <div class="row mb-4">
              <div class="col text-center">
                <p class="h4 animated fadeIn">¿Deseas generar tu orden de prepedido?</p>
              </div>
            </div>
            <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " id="Fecha1" name="Fecha1">
  <input type="text" name="Sucursal" hidden value="<?php echo $row['Fk_Sucursal']?>">
  <script>
  document.addEventListener("DOMContentLoaded", function() {
    const dateInput = document.getElementById('Fecha1');
    
    // Obtenemos la fecha actual
    const today = new Date();
    
    // Calculamos la fecha de hace 3 días
    const threeDaysAgo = new Date();
    threeDaysAgo.setDate(today.getDate() - 3);
    
    // Convertimos la fecha a formato 'YYYY-MM-DD' para que sea válida para el input de tipo date
    const formattedThreeDaysAgo = threeDaysAgo.toISOString().split('T')[0];
    const formattedToday = today.toISOString().split('T')[0];
    
    // Establecemos los atributos min y max para limitar la selección de fechas
    dateInput.setAttribute('min', formattedThreeDaysAgo);
    dateInput.setAttribute('max', formattedToday);
  });
</script>
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " name="Fecha2"  id="Fecha2">
    </div>
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    const dateInput = document.getElementById('Fecha2');
    
    // Obtenemos la fecha actual
    const today = new Date();
    
    // Convertimos la fecha a formato 'YYYY-MM-DD'
    const formattedToday = today.toISOString().split('T')[0];
    
    // Establecemos el valor por defecto en el campo de fecha
    dateInput.value = formattedToday;
  });
</script>

  <div>     </div>
  </div>  </div>
            <input type="text" hidden class="form-control" name="Mes"value="<?php echo $row['Fk_Sucursal']?>">
            <div class="row">
              <div class="col text-center">
                <button type="submit" id="submit_registroarea" value="Guardar" class="btn btn-success btn-lg animated rubberBand">Generar <i class="fas fa-exchange-alt ml-2"></i></button>
              </div>
            </div>
            
          </form>
        </div>
        
      </div>
      
    </div>
  </div>
</div>
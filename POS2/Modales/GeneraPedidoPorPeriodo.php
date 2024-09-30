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
                <p class="h4 animated fadeIn">¿Deseas generar tu orden de pedido?</p>
              </div>
            </div>
            <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " readonly id="Fecha1" name="Fecha1">
  <input type="text" name="Sucursal" hidden value="<?php echo $row['Fk_Sucursal']?>">
  <script>
  document.addEventListener("DOMContentLoaded", function() {
    const dateInput = document.getElementById('Fecha1');
    
    // Obtenemos la fecha actual
    const today = new Date();
    const dayOfWeek = today.getDay(); // 0: domingo, 1: lunes, ..., 6: sábado
    
    // Definimos los días que restarás según el día de la semana
    let daysToSubtract;
    switch(dayOfWeek) {
      case 1: // Lunes
        daysToSubtract = 3;
        break;
      case 2: // Martes
        daysToSubtract = 2;
        break;
      case 3: // Miércoles
        daysToSubtract = 3;
        break;
      case 4: // Jueves
        daysToSubtract = 1;
        break;
      case 5: // Viernes
        daysToSubtract = 1;
        break;
      case 6: // Sábado
        daysToSubtract = 1;
        break;
      case 0: // Domingo
        daysToSubtract = 3; // Empieza con lunes, restamos 3
        break;
      default:
        daysToSubtract = 3; // Por defecto restamos 3 días si algo falla
    }

    // Calculamos la fecha restando los días necesarios
    const calculatedDate = new Date();
    calculatedDate.setDate(today.getDate() - daysToSubtract);
    
    // Convertimos la fecha a formato 'YYYY-MM-DD' para el input de tipo date
    const formattedCalculatedDate = calculatedDate.toISOString().split('T')[0];
    const formattedToday = today.toISOString().split('T')[0];
    
    // Establecemos los atributos min y max para limitar la selección de fechas
    dateInput.setAttribute('min', formattedCalculatedDate);
    dateInput.setAttribute('max', formattedToday);
    
    // Asignamos la fecha calculada al valor del input
    dateInput.value = formattedCalculatedDate;
  });
</script>


    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " readonly name="Fecha2"  id="Fecha2">
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
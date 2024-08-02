<div class="modal fade bd-example-modal-xl" id="PedidoPorDia" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
      
      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Generando pedidos<i class="fas fa-credit-card ml-2"></i></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="icon-container mb-4">
            <i class="fas fa-store fa-5x animated bounceIn"></i>
          </div>
          
          <form action="PedidoPorPeriodo" method="post" >
            
            
            
            <div class="row mb-4">
              <div class="col text-center">
                <p class="h4 animated fadeIn">¿Deseas generar tu orden de prepedido?</p>
              </div>
            </div>
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
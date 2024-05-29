<div class="modal fade bd-example-modal-xl" id="PedidoPorDia" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
      
      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Filtrado de ventas por sucursal<i class="fas fa-credit-card ml-2"></i></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="javascript:void(0)" method="post" id="Filtrapormediodesucursalconajax">
            
            <div class="row mb-4">
              <div class="col">
                <label for="exampleFormControlInput1">Sucursal Actual</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
                  </div>
                  <input type="text" class="form-control" disabled readonly value="<?php echo $row['Nombre_Sucursal']?>">
                </div>
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col text-center">
                <p class="h5">¿Deseas generar tu orden de prepedido?</p>
              </div>
            </div>
            
            <div class="row">
              <div class="col text-center">
                <button type="submit" id="submit_registroarea" value="Guardar" class="btn btn-success">Generar <i class="fas fa-exchange-alt ml-2"></i></button>
              </div>
            </div>
            
          </form>
        </div>
        
      </div>
      
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGaTmrJ3HivW2UG0pE8E2J/Uf3" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
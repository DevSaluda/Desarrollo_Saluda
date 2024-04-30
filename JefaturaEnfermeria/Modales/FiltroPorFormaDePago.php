
  
      <div class="modal fade bd-example-modal-xl" id="FiltraPorFormasDePago" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Filtra por forma de pago<i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">



      
 <form  method="POST" action="FiltraVentasPorFormaDePago">
    
 
 

  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha Inicio </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " name="Fecha1">
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Fecha Fin </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " name="Fecha2">
    </div>
    

  <div>     </div>
  </div> 
  <div class="col">
    <label for="exampleFormControlInput1">Forma de pago
    </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <select name="FormaPago" id="formapago" class="form-control">
  <option value="">Seleccione una forma de pago:</option>
        <?php
          $query = $conn -> query ("SELECT DISTINCT FormaDePago FROM Ventas_POS GROUP BY FormaDePago");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["FormaDePago"].'">'.$valores["FormaDePago"].'</option>';
          }
        ?>  
  </select>
    </div>
    

  <div>     </div>
  </div>  </div>
      <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Realizar busqueda <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  
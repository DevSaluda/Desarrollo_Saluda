
  
      <div class="modal fade bd-example-modal-xl" id="DescargarInventarios" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Filtrado de ventas por sucursal<i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form action="javascript:void(0)" method="post" id="Filtrapormediodesucursalconajax">
    
 
 <div class="row">
    <div class="col">
   
    <div class="input-group mb-3">
 
  <p> Tu sucursal actual es <?php echo $row['Nombre_Sucursal']?> </p>

    </div>
    </div>
    
    </div>
      <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Descargar Inventario <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  
<div class="modal fade" id="NoCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">No hay ninguna caja abierta</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-exclamation-triangle fa-4x animated rotateIn"></i>
        <br><br>
    
      <p>Estimado <?echo $row['Nombre_Apellidos']?> no ha realizado la apertura de su caja del día <? echo $fcha; ?> <br>
      Le recomendamos realicé  la apertura, para poder iniciar los procesos que usted requiera </p>
   
      </div>

      <!--Footer-->
      <!-- <div class="modal-footer flex-center">
        
        <a href="AdministraCaja" class="btn  btn-success" >Apertura de caja</a>
       
      </div> -->
    </div>
    <!--/.Content-->
  </div>
</div>

<div class="modal fade" id="NoCajaEnCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">No hay ninguna caja abierta</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-exclamation-triangle fa-4x animated rotateIn"></i>
        <br><br>
     
      
      <p>Estimado <?echo $row['Nombre_Apellidos']?> no ha realizado la apertura de su caja del día <? echo $fcha; ?> <br>
      Le recomendamos realicé  la apertura, para poder iniciar los procesos que usted requiera </p>
   
      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
       
        
       
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
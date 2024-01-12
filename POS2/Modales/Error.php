<?$fcha = date("Y-m-d");?>
<div class="modal fade" id="ErrorData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">No se puede procesar la solicitud</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-exclamation-triangle fa-4x animated rotateIn"></i>
        <br><br>
     
      <p>No se puede completar la acción solicitada, intente de nuevo </p>
      <p>Si el problema persiste contacte a soporte.</p>
      <p class="btn  btn-outline-danger" style="color: white;">Codigo de error 201</p>
      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="" class="btn  btn-danger" data-dismiss="modal">Ok</a>
       
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

<div class="modal fade" id="ErrorDupli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">No se puede procesar la solicitud</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-exclamation-triangle fa-4x animated rotateIn"></i>
        <br><br>
     
      <p>No se puede completar la acción solicitada </p>
      <p>Los datos ingresados, ya existen en el sistema, verifique por favor.</p>
      <p class="btn  btn-outline-danger" style="color: white;">Codigo de error 250</p>
      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="" class="btn  btn-danger" data-dismiss="modal">Ok</a>
       
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

<div class="modal fade" id="ErrorCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Ya esta abierta una caja</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-exclamation-triangle fa-4x animated rotateIn"></i>
        <br><br>
     
      <p>No se puede completar la acción </p>
      <p>El usuario <?echo $row['Nombre_Apellidos']?> ya ha realizado la apertura de su caja del dia <? echo $fcha; ?> </p>
      <p class="btn  btn-outline-danger" style="color: white;">Si el problema persiste,  contacta al administrador o al equipo de soporte</p>
      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="" class="btn  btn-danger" data-dismiss="modal">Ok</a>
       
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>


<div class="modal fade" id="Sinwifi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">No hay conexión a internet</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="far fa-frown fa-4x animated rotateIn"></i>
 <br>
     
     
      <p><?echo $row['Nombre_Apellidos']?> Se ha perdido la conexión a internet </p>
     
      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="" class="btn  btn-danger" data-dismiss="modal">Ok</a>
       
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

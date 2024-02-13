<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="ConfirmacionCorrecta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true"  style="overflow-y: scroll;">
  <div class="modal-dialog modal-sm modal-notify modal-success" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Datos confirmados</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-user-check fa-4x animated rotateIn"></i>
       
      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a type="button" class="btn  btn-success waves-effect" data-dismiss="modal">Ok <i class="fas fa-thumbs-up"></i></a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->

<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="ConfirmacionErronea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true"  style="overflow-y: scroll;">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">No se pueden confirmar los datos</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-user-times fa-4x animated rotateIn"></i>
        <br><br>
     
      <p>No se puede completar la acción solicitada,intente de nuevo </p>
      <p>Si el problema persiste contacte a soporte.</p>
      <p class="btn  btn-outline-danger" style="color: white;">Codigo de error 201</p>
      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Ok <i class="fas fa-thumbs-up"></i></a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->

<div class="modal fade" id="Espere" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true"  style="overflow-y: scroll;">
<div class="modal-dialog modal-notify modal-success" role="document">
          <!--Content-->
          <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
              <p class="heading">Estatus de acciones</p>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">×</span>
              </button>
            </div>

            <!--Body-->
            <div class="modal-body">

              <div class="row">
                <div class="col-3 text-center">
                  <img  src="../Perfiles/<?php echo $row['file_name']?>" alt="Perfil de usuario" class="img-fluid z-depth-1-half rounded-circle">
                  <div style="height: 10px"></div>
                  <p class="title mb-0"><?php echo $row['Nombre_Apellidos']?></p>
                  <p class="text-muted " style="font-size: 13px"><?php echo $row['Nombre_rol']?></p>
                </div>
            
                <div class="col-9">
                <div class="text-center">
                  <p>Se guardaron correctamente los datos de paciente. <br>

Se actualizó el estatus de la cita del paciente <br>

Estatus actual <br>
<button class="btn btn-default btn-sm" style="background-color:#ffbb33  !important">En espera</button>
                  </p>
                  <p class="card-text">
                    <strong>Para verificar la información haz clic en el botón continuar <i class="fas fa-arrow-down"></i></strong>
                  </p>
                </div>
              </div>
              </div>

            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
              <a type="button" href="https://saludapos.com/CEnfermeria/ListadoDataPacientes" class="btn btn-success waves-effect waves-light">Continuar
              <i class="fas fa-arrow-right"></i>
              </a>
             
            </div>
          </div>
          <!--/.Content-->
        </div> </div>
         
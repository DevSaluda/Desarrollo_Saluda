<div class="modal fade" id="Migra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true"  style="overflow-y: scroll;"  data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-notify modal-warning" role="document">
          <!--Content-->
          <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
              <p class="heading">Aviso</p>

            
            </div>

            <!--Body-->
            <div class="modal-body">

              <div class="row">
                <div class="col-3 text-center">
                  <img  src="../Perfiles/<?echo $row['file_name']?>" alt="Perfil de usuario" class="img-fluid z-depth-1-half rounded-circle">
                  <div style="height: 10px"></div>
                  <p class="title mb-0"><?echo $row['Nombre_Apellidos']?></p>
                  <p class="text-muted " style="font-size: 13px"><?echo $row['Nombre_rol']?></p>
                </div>
            
                <div class="col-9">
                <div class="text-center">
                  <p>Estamos completando el proceso de migración, el agendamiento de citas estará disponible antes del medio día 


                  <p class="card-text">
                    <strong>Lamentamos los inconvenientes que les ocasionemos</strong>
                  </p>
                </div>
              </div>
              </div>

            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
            
             
            </div>
          </div>
          <!--/.Content-->
        </div> </div>

        <div class="modal fade" id="RememberHoras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true"  style="overflow-y: scroll;"  data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-notify modal-warning" role="document">
          <!--Content-->
          <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
              <p class="heading">Aviso</p>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">×</span>
              </button>
            </div>

            <!--Body-->
            <div class="modal-body">

              <div class="row">
                <div class="col-3 text-center">
                  <img  src="../Perfiles/<?echo $row['file_name']?>" alt="Perfil de usuario" class="img-fluid z-depth-1-half rounded-circle">
                  <div style="height: 10px"></div>
                  <p class="title mb-0"><?echo $row['Nombre_Apellidos']?></p>
                  <p class="text-muted " style="font-size: 13px"><?echo $row['Nombre_rol']?></p>
                </div>
            
                <div class="col-9">
                <div class="text-center">
                  <p>Te recomendamos que antes de iniciar el proceso de nuevas fechas para consultas, finalizar las que ya vencieron.<br>

                  Recuerda que primero debes desactivar los horarios de citas, y las fechas después de esa acción
                  </p>
                  <p class="card-text">
                    <strong>Para iniciar el proceso de finalización haz clic en el botón de abajo<i class="fas fa-arrow-down"></i></strong>
                  </p>
                </div>
              </div>
              </div>

            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
              <a type="button" href="https://controlfarmacia.com/ControldecitasV2/HorariosCampa%C3%B1as" class="btn btn-success waves-effect waves-light">Continuar
              <i class="fas fa-arrow-alt-circle-right"></i>
              </a>
             
            </div>
          </div>
          <!--/.Content-->
        </div> </div>
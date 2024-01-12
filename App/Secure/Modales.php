<!-- Central Modal Medium Info -->
<div class="modal fade" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-info" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header default-color" >
         <p class="heading lead">Contacto a soporte</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <div class="alert alert-success alert-dismissible fade show" id="success" style="display:none;" role="alert">
  <strong>Se ha enviado tu reporte</strong> , nos pondremos en contacto contigo lo más pronto posible !
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

       <!--Body-->
       <div class="modal-body">
         
         <div class="text-center">
           <i id="Contacto" class="fas fa-tools fa-4x mb-3 animated bounce"  style="
    color: #2bbbad"></i>
           <div class="alert alert-success alert-dismissible"  style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
<form  method="post" id="Soporte">
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombre y apellidos"  maxlength="40">
    </div>
    <div class="col">
      <input type="text" class="form-control" name="correo" id="correo"placeholder="Correo electronico" maxlength="30">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Numero de telefono" maxlength="10">
    </div>
    <div class="col">
    <select id = "empresa" class = "form-control" name = "empresa">
                                               <option value="">Elige una empresa:</option>
                                               <option value="Doctor Consulta">Doctor Consulta</option>
        </select>
     
    </div>
  </div>
  <br>
  <div class="form-group">
    <textarea class="form-control" id="descripcion"placeholder="Descripcion del problema" name="descripcion" maxlength="150" rows="3"></textarea>
  </div>
  <input type="text" class="form-control" name="Sistema" readonly hidden id="Sistema" value="Punto De Venta" >
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <button type="submit" class="btn btn-default" name="CS" id="CS">Enviar <i class="fas fa-paper-plane"></i></button>
       
       </div>
       </form>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Info-->


 <!-- Full Height Modal Right -->
<div class="modal fade right" id="AcercaDe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
  <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Historial</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">×</span>
          </button>
        </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-laptop-medical fa-4x mb-3 animated rotateIn"></i>
            <p>Por medio de este historial puedes verificar o volver a editar campos que actualmente no se encuentran 
                disponibles dentro de las opciones para programar campañas o incluso alguna especialidad o medico especialista
            </p>
            <a href="HistorialSucursales" class="btn btn-info">Sucursales
            <i class="fas fa-hospital-alt"></i>
            </a>
            <a href="HistorialEspecialidades" class="btn btn-info">Especialidades
              <i class="fab fa-medrt"></i>
            </a>
            <a href="HistorialEspecialistas" class="btn btn-info">Especialistas
              <i class="fab fa-medrt"></i>
            </a>
            <a href="HistorialCostos" class="btn btn-success">Costos especialistas
            <i class="fas fa-money-bill-alt"></i>
            </a>
            <a href="HistorialFechas" class="btn btn-success">Fechas especialistas
            <i class="fas fa-money-bill-alt"></i>
            </a>
            <a href="HistorialHorarios" class="btn btn-success">Horarios especialistas
            <i class="fas fa-money-bill-alt"></i>
            </a>
            <a href="HistorialCampañas" class="btn btn-success">Citas campañas
            <i class="fas fa-money-bill-alt"></i>
            </a>

          </div>
    
      </div>
      <div class="modal-footer justify-content-center">
       
      </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right -->
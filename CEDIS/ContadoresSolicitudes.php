<?include "Consultas/ContadoresGenerales.php";?>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#solicitar" role="tab" aria-controls="pills-profile" aria-selected="false">Solicitudes <?echo $SolicitudesPorver['TotalSolicitud']?> </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#solicitudesenviadas" role="tab" aria-controls="pills-contact" aria-selected="false">Solicitudes aprobadas <?echo $SolicitudesAprobadas['TotalAprobados']?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#autorizados" role="tab" aria-controls="pills-contact" aria-selected="false">Solicitudes finalizadas  <?echo $SolicitudesRechazadas['TotalRechazadas']?></a>
  </li>
</ul>
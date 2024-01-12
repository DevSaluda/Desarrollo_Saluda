<?include "Consultas/ContadorAlmacen.php";?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Categorías <?echo $TotalCategorias['TotalCategoriass']?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-TipPro" role="tab" aria-controls="pills-profile" aria-selected="false">Tipo de productos <?echo $TotalTipoProductos['TotalTipoProd']?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Presentaciones <?echo $Tpresentaciones['TotalPresentaciones']?> </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Marcas <?echo $TotalMarcas['TotalMarcas']?> </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#ServiciosS" role="tab" aria-controls="pills-contact" aria-selected="false">Servicios <?echo $TServicios['TotalServiciosPOS']?></a>
  </li>
</ul>
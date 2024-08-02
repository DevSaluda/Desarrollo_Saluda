function CargaProductos(){


    $.get("https://saludapos.com/CEDISMOVIL/Consultas/ListaTraspasosCEDISMOVIL.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();
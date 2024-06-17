function ServiciosCarga(){


    $.post("https://saludapos.com/ControlDental/Consultas/Servicios.php","",function(data){
      $("#TableServicios").html(data);
    })

  }
  
  
  
  ServiciosCarga();
function ServiciosCarga(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/Servicios.php","",function(data){
      $("#TableServicios").html(data);
    })

  }
  
  
  
  ServiciosCarga();
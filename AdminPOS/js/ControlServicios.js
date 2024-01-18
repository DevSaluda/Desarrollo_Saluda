function ServiciosCarga(){


    $.post("https://saludapos.com/AdminPOS/Consultas/Servicios.php","",function(data){
      $("#TableServicios").html(data);
    })

  }
  
  
  
  ServiciosCarga();
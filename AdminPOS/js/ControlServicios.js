function ServiciosCarga(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/Servicios.php","",function(data){
      $("#TableServicios").html(data);
    })

  }
  
  
  
  ServiciosCarga();
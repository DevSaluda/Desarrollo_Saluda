function ServiciosCarga(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Servicios.php","",function(data){
      $("#TableServicios").html(data);
    })

  }
  
  
  
  ServiciosCarga();
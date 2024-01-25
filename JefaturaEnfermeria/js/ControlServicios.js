function ServiciosCarga(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/Servicios.php","",function(data){
      $("#TableServicios").html(data);
    })

  }
  
  
  
  ServiciosCarga();
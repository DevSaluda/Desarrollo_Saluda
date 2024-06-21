function ServiciosCarga(){


    $.post("https://saludapos.com/ControlDental/Consultas/TiposConsultas.php","",function(data){
      $("#TableConsultas").html(data);
    })

  }
  
  
  
  ServiciosCarga();
function  SolicitudesAutorizadas(){


    $.post("https://saludapos.com/POS2/Consultas/SolicitudesAutorizadas.php","",function(data){
      $("#TableSolicitudesAutorizadas").html(data);
    })

  }
  
  
  
  SolicitudesAutorizadas();
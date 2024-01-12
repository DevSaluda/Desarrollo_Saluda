function  SolicitudesAutorizadas(){


    $.post("https://controlfarmacia.com/POS2/Consultas/SolicitudesAutorizadas.php","",function(data){
      $("#TableSolicitudesAutorizadas").html(data);
    })

  }
  
  
  
  SolicitudesAutorizadas();
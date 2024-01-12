function  SolicitudesAutorizadas(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/SolicitudesAutorizadas.php","",function(data){
      $("#TableSolicitudesAutorizadas").html(data);
    })

  }
  
  
  
  SolicitudesAutorizadas();
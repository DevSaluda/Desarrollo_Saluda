function  SolicitudesAutorizadas(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/SolicitudesAutorizadas.php","",function(data){
      $("#TableSolicitudesAutorizadas").html(data);
    })

  }
  
  
  
  SolicitudesAutorizadas();
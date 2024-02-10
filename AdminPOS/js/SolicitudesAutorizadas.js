function  SolicitudesAutorizadas(){


    $.post("https://saludapos.com/AdminPOS/Consultas/SolicitudesAutorizadas.php","",function(data){
      $("#TableSolicitudesAutorizadas").html(data);
    })

  }
  
  
  
  SolicitudesAutorizadas();
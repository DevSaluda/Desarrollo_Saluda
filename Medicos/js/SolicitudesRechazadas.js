function  SolicitudesRechazadas(){


    $.post("https://saludapos.com/AdminPOS/Consultas/SolicitudesRechazadas.php","",function(data){
      $("#TableSolicitudesRechazadas").html(data);
    })

  }
  
  
  
  SolicitudesRechazadas();
function  SolicitudesRechazadas(){


    $.post("https://saludapos.com/POS2/Consultas/SolicitudesRechazadas.php","",function(data){
      $("#TableSolicitudesRechazadas").html(data);
    })

  }
  
  
  
  SolicitudesRechazadas();
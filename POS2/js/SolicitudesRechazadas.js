function  SolicitudesRechazadas(){


    $.post("https://controlfarmacia.com/POS2/Consultas/SolicitudesRechazadas.php","",function(data){
      $("#TableSolicitudesRechazadas").html(data);
    })

  }
  
  
  
  SolicitudesRechazadas();
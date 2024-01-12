function  SolicitudesRechazadas(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/SolicitudesRechazadas.php","",function(data){
      $("#TableSolicitudesRechazadas").html(data);
    })

  }
  
  
  
  SolicitudesRechazadas();
function  SolicitudesRechazadas(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/SolicitudesRechazadas.php","",function(data){
      $("#TableSolicitudesRechazadas").html(data);
    })

  }
  
  
  
  SolicitudesRechazadas();
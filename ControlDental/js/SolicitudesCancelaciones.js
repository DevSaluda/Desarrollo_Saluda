function  SolicitudesCancelaciones(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/SolicitudesDecancelaciones.php","",function(data){
      $("#TableSolicitudesCancelaciones").html(data);
    })

  }
  
  
  
  SolicitudesCancelaciones();
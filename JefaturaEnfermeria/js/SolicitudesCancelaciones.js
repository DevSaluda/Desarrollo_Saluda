function  SolicitudesCancelaciones(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/SolicitudesDecancelaciones.php","",function(data){
      $("#TableSolicitudesCancelaciones").html(data);
    })

  }
  
  
  
  SolicitudesCancelaciones();
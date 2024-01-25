function CargaPresentaciones(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/Presentaciones.php","",function(data){
      $("#TablePresentaciones").html(data);
    })
  
  }
  
  
  
  CargaPresentaciones();

  
  
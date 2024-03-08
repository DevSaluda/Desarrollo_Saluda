function CargaPresentaciones(){


    $.get("https://saludapos.com/AdminPOS/Consultas/Presentaciones.php","",function(data){
      $("#TablePresentaciones").html(data);
    })
  
  }
  
  
  
  CargaPresentaciones();

  
  
function CargaComponentesActivos(){


    $.get("https://saludapos.com/AdminPOS/Consultas/ComponentesActivos.php","",function(data){
      $("#ComponentesActivos").html(data);
    })
  
  }
  
  CargaComponentesActivos();

  
  
  

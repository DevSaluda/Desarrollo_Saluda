function CargaComponentesActivos(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/ComponentesActivos.php","",function(data){
      $("#ComponentesActivos").html(data);
    })
  
  }
  
  CargaComponentesActivos();

  
  
  

function CargaComponentesActivos(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/ComponentesActivos.php","",function(data){
      $("#ComponentesActivos").html(data);
    })
  
  }
  
  CargaComponentesActivos();

  
  
  

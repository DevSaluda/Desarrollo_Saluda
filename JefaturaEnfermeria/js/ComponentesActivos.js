function CargaComponentesActivos(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/ComponentesActivos.php","",function(data){
      $("#ComponentesActivos").html(data);
    })
  
  }
  
  CargaComponentesActivos();

  
  
  

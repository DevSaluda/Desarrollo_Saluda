function CargaSignosVitales(){


    $.get("https://saludapos.com/ControlDental/Consultas/RegistroDeEntradasPorDiasHuellas.php","",function(data){
      $("#RegistrosEntradas").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  

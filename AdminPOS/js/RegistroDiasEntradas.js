function CargaSignosVitales(){


    $.get("https://saludapos.com/AdminPOS/Consultas/RegistroDeEntradasPorDiasHuellas.php","",function(data){
      $("#RegistrosEntradas").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  

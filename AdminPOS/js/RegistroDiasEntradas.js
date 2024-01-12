function CargaSignosVitales(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/RegistroDeEntradasPorDiasHuellas.php","",function(data){
      $("#RegistrosEntradas").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  

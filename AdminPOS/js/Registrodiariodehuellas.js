function Cargalashuellas(){


    $.post("https://saludapos.com/AdminPOS/Consultas/RegistroDeEntradasPorDiasHuellas.php","",function(data){
      $("#RegistrosEntradas").html(data);
    })
  
  }
  
  
  Cargalashuellas();

  

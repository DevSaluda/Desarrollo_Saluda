function Cargalashuellas(){


    $.post("https://saludapos.com/AdminPOS/Consultas/RegistroDeEntradasPorDiasHuellas.php","",function(data){
      $("#Registros").html(data);
    })
  
  }
  
  
  Cargalashuellas();

  

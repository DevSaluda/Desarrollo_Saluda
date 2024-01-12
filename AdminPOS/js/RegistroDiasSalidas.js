function CargaSalidas(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/RegistroDeSalidasPorDiasHuellas.php","",function(data){
      $("#RegistrosSalidas").html(data);
    })
  
  }
  
  
  CargaSalidas();

  

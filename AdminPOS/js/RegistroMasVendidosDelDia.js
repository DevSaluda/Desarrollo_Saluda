function CargaMasVendidos(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/RegistroDeMasVendidosPorDia.php","",function(data){
      $("#RegistrosMasVendidosDias").html(data);
    })
  
  }
  
  
  CargaMasVendidos();

  

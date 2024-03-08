function CargaMasVendidos(){


    $.get("https://saludapos.com/AdminPOS/Consultas/RegistroDeMasVendidosPorDia.php","",function(data){
      $("#RegistrosMasVendidosDias").html(data);
    })
  
  }
  
  
  CargaMasVendidos();

  

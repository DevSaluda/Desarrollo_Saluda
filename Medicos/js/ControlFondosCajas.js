function CargaFCajas(){


    $.get("https://saludapos.com/AdminPOS/Consultas/FondosCajas.php","",function(data){
      $("#FCajas").html(data);
    })
  
  }
  
  
  
  CargaFCajas();

  
  
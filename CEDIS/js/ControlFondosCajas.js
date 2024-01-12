function CargaFCajas(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/FondosCajas.php","",function(data){
      $("#FCajas").html(data);
    })
  
  }
  
  
  
  CargaFCajas();

  
  
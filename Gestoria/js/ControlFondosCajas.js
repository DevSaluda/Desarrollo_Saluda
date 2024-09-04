function CargaFCajas(){


    $.get("https://controlfarmacia.com/POS2/Consultas/FondosCajas.php","",function(data){
      $("#FCajas").html(data);
    })
  
  }
  
  
  
  CargaFCajas();

  
  
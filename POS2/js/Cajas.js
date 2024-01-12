function CargaCajas(){


    $.get("https://controlfarmacia.com/POS2/Consultas/Cajas.php","",function(data){
      $("#Cajas").html(data);
    })
  
  }
  
  
  
  CargaCajas();

  
  
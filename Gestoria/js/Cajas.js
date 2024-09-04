function CargaCajas(){


    $.get("https://saludapos.com/POS2/Consultas/Cajas.php","",function(data){
      $("#Cajas").html(data);
    })
  
  }
  
  
  
  CargaCajas();

  
  
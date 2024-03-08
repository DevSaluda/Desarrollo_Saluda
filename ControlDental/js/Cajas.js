function CargaCajas(){


    $.get("https://saludapos.com/AdminPOS/Consultas/Cajas.php","",function(data){
      $("#Cajas").html(data);
    })
  
  }
  
  
  
  CargaCajas();

  
  
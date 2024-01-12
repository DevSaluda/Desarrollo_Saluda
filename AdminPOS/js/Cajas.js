function CargaCajas(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Cajas.php","",function(data){
      $("#Cajas").html(data);
    })
  
  }
  
  
  
  CargaCajas();

  
  
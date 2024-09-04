function   CargaCancelados(){


    $.post("https://saludapos.com/POS2/Consultas/CancelacionesAgenda.php","",function(data){
      $("#Cancelaciones").html(data);
    })
  
  }
  
  
  CargaCancelados();

  

  

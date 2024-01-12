function   CargaCancelados(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CancelacionesAgenda.php","",function(data){
      $("#Cancelaciones").html(data);
    })
  
  }
  
  
  CargaCancelados();

  

  

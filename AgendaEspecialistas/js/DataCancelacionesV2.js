function   CargaCancelados(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/CancelacionesV2.php","",function(data){
      $("#Cancelaciones").html(data);
    })
  
  }
  
  
  CargaCancelados();

  

  

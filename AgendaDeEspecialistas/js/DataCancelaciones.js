function   CargaCancelados(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/Cancelaciones.php","",function(data){
      $("#Cancelaciones").html(data);
    })
  
  }
  
  
  CargaCancelados();

  

  

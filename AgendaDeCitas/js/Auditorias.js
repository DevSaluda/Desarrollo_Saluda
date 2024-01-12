function   CargaCancelados(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/Auditorias.php","",function(data){
      $("#Cancelaciones").html(data);
    })
  
  }
  
  
  CargaCancelados();

  

  

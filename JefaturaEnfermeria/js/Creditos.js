function CargaCreditos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Creditos.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaCreditos();
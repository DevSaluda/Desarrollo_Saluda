function   CargaCancelados(){


    $.post("https://controlconsulta.com/Enfermeria2/Consultas/CancelacionesV2.php","",function(data){
      $("#Cancelaciones").html(data);
    })
  
  }
  
  
  CargaCancelados();

  

  

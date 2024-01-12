function   CargaCancelados(){


    $.post("https://controlconsulta.com/Enfermeria2/Consultas/Cancelaciones.php","",function(data){
      $("#Cancelaciones").html(data);
    })
  
  }
  
  
  CargaCancelados();

  

  

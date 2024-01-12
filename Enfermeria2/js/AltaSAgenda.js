function CargaSa(){


    $.get("https://controlconsulta.com/Enfermeria2/Consultas/SignosAgenda.php","",function(data){
      $("#AgendaSV").html(data);
    })
  
  }
  
  
  
  CargaSa();

function PacientesAgenda(){


    $.get("https://controlconsulta.com/Enfermeria2/Consultas/SignosVitalesEspeciales.php","",function(data){
      $("#PacAgen").html(data);
    })
  
  }
  
  
  
  PacientesAgenda();

  

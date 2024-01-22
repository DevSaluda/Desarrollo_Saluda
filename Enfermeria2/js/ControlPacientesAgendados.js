function CargaPacientesAgenda(){


    $.post("https://controlconsulta.com/Enfermeria2/Consultas/AgendaPacientesCompletos.php","",function(data){
      $("#Pacientes").html(data);
    })
  
  }
  
  
  
  CargaPacientesAgenda();

  

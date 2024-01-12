function CargaLab(){


    $.post("https://controlconsulta.com/Enfermeria2/Consultas/ControlDeLabs.php","",function(data){
      $("#Pacientes").html(data);
    })
  
  }
  

  CargaLab();

  

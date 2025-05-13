function CargaEspecialidades(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/Especialidades.php","",function(data){
      $("#EspecialidadesVi").html(data);
    })
  
  }
  
  
  
  CargaEspecialidades();

  

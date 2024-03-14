function AreasCreditos(){


    $.post("https://saludapos.com/ControlDental/Consultas/AreasCreditos.php","",function(data){
      $("#TableAreasCreditos").html(data);
    })

  }
  
  
  
  AreasCreditos();
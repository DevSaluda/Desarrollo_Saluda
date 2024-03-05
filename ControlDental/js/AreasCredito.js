function AreasCreditos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/AreasCreditos.php","",function(data){
      $("#TableAreasCreditos").html(data);
    })

  }
  
  
  
  AreasCreditos();
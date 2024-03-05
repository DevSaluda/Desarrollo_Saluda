function CargaMarcas(){


    $.get("https://saludapos.com/AdminPOS/Consultas/Marcas.php","",function(data){
      $("#TableMarcas").html(data);
    })
  
  }
  
  
  
  CargaMarcas();

  
  
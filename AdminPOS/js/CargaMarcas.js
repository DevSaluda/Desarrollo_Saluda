function CargaMarcas(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Marcas.php","",function(data){
      $("#TableMarcas").html(data);
    })
  
  }
  
  
  
  CargaMarcas();

  
  
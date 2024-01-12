function  CargaGestionventas(){


    $.post("https://controlfarmacia.com/POS2/VistaDeLasVentas.php","",function(data){
      $("#Tabladeventas").html(data);
    })

  }
  
  
  
  CargaGestionventas();
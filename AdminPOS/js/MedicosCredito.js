function MedicosCreditos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/MedicosCreditos.php","",function(data){
      $("#TableMedicosCreditos").html(data);
    })

  }
  
  
  
  MedicosCreditos();
<?php 
  $hora = date('G'); if (($hora >= 23) AND ($hora < 7)) 
  { 
    
    $Turno = "Nocturno"; 
  } 
  else if (($hora >= 7) AND ($hora <3)) 
  { 
    $Turno = "Matutino"; 
  } 
  else if (($hora >= 15) AND ($hora < 23)) 
  { 
    $Turno = "Vespertino"; 
  } 
  else
  { 
  $Turno = "Matutino"; 
  } 

?>
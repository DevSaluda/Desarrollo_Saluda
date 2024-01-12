function Municipio()
{
 
/* Para obtener el texto */
var combo = document.getElementById("municipio");
var selected = combo.options[combo.selectedIndex].text;
$("#municipior").val(selected);
}

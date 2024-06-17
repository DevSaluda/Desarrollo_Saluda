function Localidad()
{
var combo = document.getElementById("localidad");
var selected = combo.options[combo.selectedIndex].text;
$("#localidadr").val(selected);
}

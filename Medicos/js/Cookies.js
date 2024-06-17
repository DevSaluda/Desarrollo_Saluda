var viewed = Cookies.get('viewed');

console.log(viewed)

if (viewed == true) {
  $(".modal").fadeOut();
} else if (viewed == undefined) {
  Cookies.set('viewed', true);
}
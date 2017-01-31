$( document ).ready(function() {

  $('#star0').click(function() {
    alert("hello");
  });

});

function rate(userId, movieId, category, rating) {

  var data = {
    "userId": userId,
    "movieId": movieId,
    "category": category,
    "rating": rating,
  };
  console.log(data);
  $.post("http://localhost/movie-archivator/ratings/rate", data);
}

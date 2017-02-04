$(document).ready(function() {

});

function rate(userId, movieId, category, rating) {

  var data = {
    "userId": userId,
    "movieId": movieId,
    "category": category,
    "rating": rating,
  };
  console.log(data);
  $.ajax({
    type: "POST",
    url: "http://localhost/movie-archivator/ratings/rate",
    data: data
  }).done(function(data) {
    getTotalRating(userId, movieId);
  });
}

function getTotalRating(userId, movieId) {
  var targetUri = "http://localhost/movie-archivator/ratings/total/" + encodeURIComponent(movieId) + "?userId=" + encodeURIComponent(userId);
  console.log(targetUri);
  $('#total-rating').load(targetUri);
}

$(document).ready(function() {

  $('#submit-search').click(function() {
    var title = $('#search').val();
    console.log(title);
    $('.movie-search-results').load('http://localhost/movie-archivator/movies/search/' + encodeURIComponent(title), function() {
      $('.movie-search-results').css('visibility', 'visible');
    });
  });

});

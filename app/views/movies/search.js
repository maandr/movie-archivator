$(document).ready(function() {

  $('#submit-search').click(function() {
    var title = $('#search').val();
    var targetUri = "http://localhost/movie-archivator/movies/search/" + encodeURIComponent(title);
    console.log(targetUri);
    $('.movie-search-results').load(targetUri, function() {
      $('.movie-search-results').css('visibility', 'visible');
    });
  });

  $('#search').keyup(function() {
    var title = $('#search').val();
    var targetUri = "http://localhost/movie-archivator/movies/search-succestion/" + encodeURIComponent(title);
    console.log(targetUri);
    $('.movie-search-results').load(targetUri, function() {
      $('.movie-search-results').css('visibility', 'visible');
    });
  });

  $('#search').focusout(function() {
    //$('.movie-search-results').css('visibility', 'hidden');
  });

});

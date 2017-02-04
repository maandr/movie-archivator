{foreach from=$Results item=Result}
	<div class="movie-search-result">
		<a href="movies/load/{$Result->imdbID}">
			<img src="{$Result->Poster}" class="poster"  />
			<h3>{$Result->Title} ({$Result->Year})</h3>
		</a>
	</div>
{/foreach}

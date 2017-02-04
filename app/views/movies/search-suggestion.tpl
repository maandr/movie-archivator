{foreach from=$Results item=Result}
	<div class="movie-search-result">
		<a href="movies/get/{$Result->id}">
			<img src="{$PosterPath}{$Result->id}.jpg" class="poster"  />
			<h3>{$Result->title} ({$Result->year})</h3>
		</a>
	</div>
{/foreach}

{extends file="index.tpl"}

{block name=content}
	<h2>Filme</h2>

	<div class="movie-search">
		<form method="get" action="{$ControllerName}/search">
			<label>Title</label>
	    <input type="text" id="search" name="search" value="" placeholder="Title" class="form-control" required autofocus />

			<input type="submit" value="Search" class="btn btn-primary btn-block" />
		</form>
	</div>

	<div class="movie-search-results">
		{foreach from=$Movies item=Movie}
		  <div class="movie-search-result">
		    <a href="{$ControllerName}/load/{$Movie->imdbID}">
		      <img src="{$Movie->Poster}" class="poster"  />
		      <h3>{$Movie->Title} ({$Movie->Year})</h3>
		    </a>
		  </div>
		{/foreach}
	</div>
{/block}

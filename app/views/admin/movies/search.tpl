{extends file="admin/index.tpl"}

{block name=content}
<div class="row">
    <div class="col-md-3">
    
    	<h2>Suche</h2>
    
		<form method="post" action="{$ControllerName}/search">
			<label>Titel</label>
			<input type="text" name="search" value="{$Search}" />
			
			<input type="submit" name="submit" value="Suchen" />
		</form>
		
    </div>
    
    <div class="col-md-9">
    
    	<h2>Ergebnisse</h2>
    
		<ul class="movie-search-results">
			{foreach from=$SearchResults item=Result}
				<li>
					<img src="{$Result->Poster}" alt="{$Result->Title}" />
					<h3><a href="{$ControllerName}/add/{$Result->imdbID}">{$Result->Title} ({$Result->Year})</a></h3>
					<a href="{$ControllerName}/add/{$Result->imdbID}"><div class="add-line"> </div></a>
				</li>
			{/foreach}
		</ul>
		
    </div>
</div>

{/block}

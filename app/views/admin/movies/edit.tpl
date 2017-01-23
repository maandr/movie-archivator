{extends file="admin/index.tpl"}

{block name=content}
<h2>Benutzer bearbeiten</h2>

<form method="post" action="{$ControllerName}/edit/{$Model->id}">

	<input type="hidden" name="userId" value="{$Model->userId}" />

	<label>Rating</label>
	<input type="text" name="rating" value="{$Model->rating}" /> (IMDB: {$Model->imdbRating})

	<br />
	<br />
	
	<label>Titel</label>
	<input type="text" name="title" value="{$Model->title}" />

	<label>Jahr</label>
	<input type="text" name="year" value="{$Model->year}" />
	
	<label>Land</label>
	<input type="text" name="country" value="{$Model->country}" />
	
	<label>Genre</label>
	<input type="text" name="genre" value="{$Model->genre}" />
	
	<label>Tags</label>
	<input type="text" name="tags" value="{$Model->tags}" />
	
	<label>Runtime</label>
	<input type="text" name="runtime" value="{$Model->runtime}" />
	
	<label>Regisseur</label>
	<input type="text" name="director" value="{$Model->director}" />
	
	<label>Autor</label>
	<input type="text" name="writer" value="{$Model->writer}" />
	
	<label>Darsteller</label>
	<input type="text" name="actors" value="{$Model->actors}" />
	
	<label>Auszeichnungen</label>
	<input type="text" name="awards" value="{$Model->awards}" />
		
	<label>Handlung</label>
	<textarea rows="5" name="plot">{$Model->plot}</textarea>
	
	<label>Kommentar</label>
	<textarea rows="5" name="comment">{$Model->comment}</textarea>
	
	<input type="submit" name="submit" value="Speichern" />
</form>

{/block}

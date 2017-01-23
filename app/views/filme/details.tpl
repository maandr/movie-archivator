{extends file="admin/index.tpl"}

{block name=content}
	<table>
		<tr>
			<td rowspan="9"><img src="{$Model->poster}" /></td>
			<td colspan="3" class="title"><h1>{$Model->title}</h1> <a href="movies/edit/{$Model->id}" class="icon edit" style="position: absolute; top: 50%; right: 10px; width: 24px; height: 24px;"></a></td>
		</tr>
		<tr>
			<td  class="bold right">Jahr</td>
			<td><a href="{$ControllerName}/jahr/{$Model->year}">{$Model->year}</a></td>
			<td rowspan="3" class="rating"><h2>{$Model->rating}</h2><br />(<a href="http://www.imdb.com/title/{$Model->imdbId}/">IMDB: {$Model->imdbRating}</a>)<td>
		</tr>
		<tr>
			<td class="bold right">Genre</td>
			<td>{$Model->genre}</td>
		</tr>
		<tr>
			<td class="bold right">Land</td>
			<td>{$Model->country}</td>
		</tr>
		<tr>
			<td class="bold right">Laufzeit</td>
			<td><{$Model->runtime}</td>
		</tr>
		<tr>
			<td class="bold right">Auszeichnungen</td>
			<td>{$Model->awards}</td>
		</tr>
		<tr>
			<td class="bold right">Regisseur</td>
			<td colspan="2">{$Model->director}</td>
		</tr>
		<tr>
			<td class="bold right">Autor</td>
			<td colspan="2">{$Model->writer}</td>
		</tr>
		<tr>
			<td class="bold right">Darsteller</td>
			<td colspan="2">{$Model->actors}</td>
		</tr>
		<tr>
			<td colspan="4" class="bold">Handlung</td>
		</tr>
		<tr>
			<td colspan="4">{$Model->plot|nl2br}</td>
		</tr>
		<tr>
			<td colspan="4" class="bold">Kommentar</td>
		</tr>
		<tr>
			<td colspan="4">{$Model->comment|nl2br}</td>
		</tr>
	</table>
{/block}
{extends file="index.tpl"}

{block name=content}
	<table>
		<tr>
			<td rowspan="9"><img src="{$Movie->poster}" /></td>
			<td colspan="3" class="title"><h1>{$Movie->title}</h1></td>
		</tr>
		<tr>
			<td  class="bold right">Jahr</td>
			<td><a href="{$ControllerName}/jahr/{$Movie->year}">{$Movie->year}</a></td>
		</tr>
		<tr>
			<td class="bold right">Genre</td>
			<td>{$Movie->genre}</td>
		</tr>
		<tr>
			<td class="bold right">Land</td>
			<td>{$Movie->country}</td>
		</tr>
		<tr>
			<td class="bold right">Laufzeit</td>
			<td><{$Movie->runtime}</td>
		</tr>
		<tr>
			<td class="bold right">Auszeichnungen</td>
			<td>{$Movie->awards}</td>
		</tr>
		<tr>
			<td class="bold right">Regisseur</td>
			<td colspan="2">{$Movie->director}</td>
		</tr>
		<tr>
			<td class="bold right">Autor</td>
			<td colspan="2">{$Movie->writer}</td>
		</tr>
		<tr>
			<td class="bold right">Darsteller</td>
			<td colspan="2">{$Movie->cast}</td>
		</tr>
		<tr>
			<td colspan="4" class="bold">Handlung</td>
		</tr>
		<tr>
			<td colspan="4">{$Movie->plot|nl2br}</td>
		</tr>
	</table>
{/block}

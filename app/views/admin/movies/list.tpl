{extends file="admin/index.tpl"}

{block name=content}
<h2>Filme</h2>

<ul class="actions">
	<li><a href="{$ControllerName}/search" class="icon create">Hinzufügen</a></li>
</ul>

<table>
	<tr>
		<th></th>
		<th>Rating</th>
		<th>Jahr</th>
		<th>Titel</th>
		<th>Bearbeiten</th>
		<th>Löschen</th>
	</tr>
	{foreach from=$Models item=Model}
	<tr>
		<td><img src="{$Model->poster}" height="75" /></td>
		<td>{$Model->rating}</td>
		<td>{$Model->year}</td>
		<td>{$Model->title}</td>
		<td><a href="{$ControllerName}/edit/{$Model->id}" class="icon edit">Bearbeiten</a></td>
		<td><a href="{$ControllerName}/delete/{$Model->id}" class="icon delete">Löschen</a></td>
	</tr>
	{/foreach}
</table>
{/block}
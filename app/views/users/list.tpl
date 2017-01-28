{extends file="index.tpl"}

{block name=content}
<h2>Benutzer</h2>

<ul class="actions">
	<li><a href="{$ControllerName}/create" class="icon create">Hinzufügen</a></li>
</ul>

<table>
	<tr>
		<th>Benutzername</th>
		<th>Rolle</th>
		<th>Bearbeiten</th>
		<th>Löschen</th>
	</tr>
	{foreach from=$Models item=Model}
	<tr>
		<td>{$Model->username}</td>
		<td>{$Model->role}</td>
		<td><a href="{$ControllerName}/edit/{$Model->id}" class="icon edit">Bearbeiten</a></td>
		<td><a href="{$ControllerName}/delete/{$Model->id}" class="icon delete">Löschen</a></td>
	</tr>
	{/foreach}
</table>
{/block}

{extends file="index.tpl"}

{block name=content}
	<h2>Filme</h2>
	<div class="table-responsive">
		<table class="table table-striped movie-table">
			<tr>
				<th></th>
				<th>Jahr</th>
				<th>Titel</th>
				<th>Regisseur</th>
			</tr>
			{foreach from=$Movies item=Movie}
			<tr>
				<td><img src="{$Movie->poster}" /></td>
				<td><a href="{$ControllerName}/jahr/{$Movie->year}">{$Movie->year}</a></td>
				<td><a href="{$ControllerName}/get/{$Movie->id}">{$Movie->title}</a></td>
				<td>{$Movie->director}</td>
			</tr>
			{/foreach}
		</table>
	</div>
{/block}

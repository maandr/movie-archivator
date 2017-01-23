{extends file="admin/index.tpl"}

{block name=context_menu}
	<p>{$Amount} Filme in der Liste</p>
	
	<p><a href="{$ControllerName}">Ganze liste anzeigen</a></p>
{/block}

{block name=content}
	<h2>Filme</h2>
	<div class="table-responsive">
		<table class="table table-striped movie-table">
			<tr>
				<th></th>
				<th>Rating</th>
				<th>Jahr</th>
				<th>Titel</th>
				<th>Regisseur</th>
			</tr>
			{foreach from=$Models item=Model}
			<tr>
				<td><img src="{$Model->poster}" /></td>
				<td><span class="star icon"></span>{$Model->rating}</td>
				<td><a href="{$ControllerName}/jahr/{$Model->year}">{$Model->year}</a></td>
				<td><a href="{$ControllerName}/details/{$Model->id}">{$Model->title}</a></td>
				<td>{$Model->director}</td>
			</tr>
			{/foreach}
		</table>
	</div>
{/block}
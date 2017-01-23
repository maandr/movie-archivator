{extends file="admin/index.tpl"}

{block name=content}
	<h2>Statistik {$Context}</h2>
	<div class="table-responsive">
		<table class="table table-striped movie-table">
			<tr>
				<th><a href="{$ControllerName}/statistics-{$Action}-amount/{$Order}">Bewertete Filme</a></th>
				<th><a href="{$ControllerName}/statistics-{$Action}-rating/{$Order}">Durchschnittsnote</a></th>
				<th><a href="{$ControllerName}/statistics-{$Action}-name/{$Order}">{$Context}</a></th>
			</tr>
			{foreach from=$Models item=Model}
			<tr>
				<td><a href="{$ControllerName}/{$Action}/{$Model->name}">{$Model->ratedAmount}</a></td>
				<td><span class="star icon"></span>{$Model->averageRating|string_format:"%.2f"}</td>
				<td><a href="{$ControllerName}/{$Action}/{$Model->name}" class="icon {$Model->name}">{$Model->name}</a></td>
			</tr>
			{/foreach}
		</table>
	</div>
{/block}
{extends file="admin/index.tpl"}

{block name=context_menu}
	<p>{$Amount} Filme in der Liste</p>

	<input type="hidden" value="{$ControllerName}/{$Action}/" id="action-base-path" />
	
	{if isset($Year)}
		<a href="{$ControllerName}/{$Action}/{$PreviousYear}" class="button-previous"></a>
	{/if}
	
	<select name="jahr" onchange="switchYear()" id="year-picker">
	{for $i=1920 to {$CurrentYear}}
		{if $i eq $Year}
			<option value="{$i}" selected="selected">{$i}</option>
		{else}
			<option value="{$i}">{$i}</option>
		{/if}
	{/for}
	</select>
	{if isset($Year)}
		<a href="{$ControllerName}/{$Action}/{$NextYear}" class="button-next"></a>
	{/if}
		
	<script type="text/javascript">
		function switchYear() {
			var actionBasePath = document.getElementById('action-base-path').value;
			var year = document.getElementById('year-picker').value;
			window.location = actionBasePath + year;
		}
	</script>
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
{extends file="admin/index.tpl"}

{block name=content}
	<h2>Tags</h2>
	
	<ul class="tag-list">
		{foreach from=$Tags item=Tag}
		<li><a href="{$ControllerName}/tags/{$Tag}">{$Tag}</a></li>
		{/foreach}
	</ul>
{/block}
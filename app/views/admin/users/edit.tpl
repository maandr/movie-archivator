{extends file="admin/index.tpl"}

{block name=content}
<h2>Benutzer bearbeiten</h2>

<form method="post" action="{$ControllerName}/edit/{$Model->id}">
	<label>Username</label>
	<input type="text" name="username" value="{$Model->username}" />
	
	<label>Password</label>
	<input type="password" name="password" value="{$Model->password}" />
	
	<label>Rolle</label>
	<select name="role">
		{foreach from=$Roles item=Role}
			{if $Role == $Model->role}
			<option value="{$Role}" selected="selected">{$Role}</option>
			{else}
			<option value="{$Role}">{$Role}</option>
			{/if}
		{/foreach}
	</select>
	
	<input type="submit" name="submit" value="Speichern" />
</form>

{/block}

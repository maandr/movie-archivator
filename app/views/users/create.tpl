{extends file="index.tpl"}

{block name=content}
<h2>Neuen Benutzer anlegen</h2>

<form method="post" action="{$ControllerName}/create">
	<label>Username</label>
	<input type="text" name="username" value="{$Model->username}" />

	<label>Password</label>
	<input type="password" name="password" value="{$Model->password}" />

	<label>Rolle</label>
	<select name="role">
		{foreach from=$Roles item=Role}
			{if $Role->name == $User->role}
			<option value="{$Role}" selected="selected">{$Role}</option>
			{else}
			<option value="{$Role}">{$Role}</option>
			{/if}
		{/foreach}
	</select>

	<input type="submit" name="submit" value="Speichern" />
</form>

{/block}

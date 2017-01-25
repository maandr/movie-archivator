{extends file="index.tpl"}

{block name=content}
  <form method="post" action="{$BaseUrl}set-password?token={$token}" class="form-signin">

    <h2>Set a new password</h2>

    <label>New Password</label>
    <input type="password" name="password" placeholder="Password" class="form-control" required autofocus />

    <label>Password</label>
    <input type="password" name="confirm-password" placeholder="Password" class="form-control" required autofocus />
    <br />

    <input type="hidden" name="token" value="{$token}" />

    <input type="submit" name="submit" value="Save" class="btn btn-primary btn-block" />
  </form>
  <a href="{$BaseUrl}register">Don't have an account yet?</a> - <a href="{$BaseUrl}Login">Login with existing account.<a>
{/block}

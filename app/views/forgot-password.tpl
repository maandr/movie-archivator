{extends file="index.tpl"}

{block name=content}
  <form method="post" action="{$BaseUrl}forgot-password" class="form-signin">

    <h2>Request a new password</h2>

    <label>Email</label>
    <input type="email" name="email" value="{$email}" placeholder="Email" class="form-control" required autofocus />

    <br />

    <input type="submit" name="submit" value="Request new password" class="btn btn-primary btn-block" />
  </form>
  <a href="{$BaseUrl}register">Don't have an account yet?</a> - <a href="{$BaseUrl}Login">Login with existing account.<a>
{/block}

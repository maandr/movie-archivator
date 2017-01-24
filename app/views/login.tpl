{extends file="index.tpl"}

{block name=content}
  <form method="post" action="{$BaseUrl}login" class="form-signin">

    <h2>Login</h2>

    <label>Username</label>
    <input type="text" name="username" value="{$username}" placeholder="Username" class="form-control" required autofocus />

    <label>Password</label>
    <input type="password" name="password" placeholder="Password" class="form-control" required autofocus />

    <br />

    <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block" />
  </form>
  <a href="{$BaseUrl}register">Don't have an account yet?</a> - <a href="{$BaseUrl}forgot-password">Forgot your password?<a>
{/block}

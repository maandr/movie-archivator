{extends file="index.tpl"}

{block name=content}

  <form method="post" action="{$BaseUrl}register" class="form-signin">

    <h2>Register new account</h2>

    <h3>Account Information</h3>

    <label>Username</label>
    <input type="text" name="username" value="{$username}" placeholder="Username" class="form-control" required autofocus />

    <label>Email</label>
    <input type="text" name="email" value="{$email}" placeholder="Email" class="form-control" required autofocus />

    <label>Password</label>
    <input type="password" name="password" placeholder="Password" class="form-control" required autofocus />

    <label>Confirm Password</label>
    <input type="password" name="confirm-password" placeholder="Password" class="form-control" required autofocus />

    <h3>Personal Information</h3>

    <label>Firstname</label>
    <input type="text" name="firstname" value="{$firstname}" placeholder="Firstname" class="form-control" autofocus />

    <label>Lastname</label>
    <input type="text" name="lastname" value="{$lastname}" placeholder="Lastname" class="form-control" autofocus />

    <br />

    <input type="submit" name="submit" value="Register" class="btn btn-primary btn-block" />
  </form>
  <a href="{$BaseUrl}login">Already have an account?</a> - <a href="{$BaseUrl}forgot-password">Forgot your password?<a>
{/block}

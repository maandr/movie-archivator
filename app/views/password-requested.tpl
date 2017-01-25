{extends file="index.tpl"}

{block name=content}
  <h2>New password requested</h2>
  <p>
    We send you and email. Please follow the instructions you will find
    in that email in order so set a new password.
  </p>
  <a href="{$BaseUrl}register">Don't have an account yet?</a> - <a href="{$BaseUrl}Login">Login with existing account.<a>
{/block}

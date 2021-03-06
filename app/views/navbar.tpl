<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{$ProjectName}</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      {if $Role != 'visitor'}
        {include file='movies/search.tpl'}
      {/if}
      <ul class="nav navbar-nav navbar-right">
        {if $Role == 'visitor'}
          <li>
            <a href="login">Login</a>
          </li>
        {else}
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{$User->username} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="">Your Profile</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="movies/rated-by-user/{$User->id}">My Ratings</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="">Settings</a></li>
                <li><a href="logout">Logout</a></li>
              </ul>
          </li>
        {/if}
      </ul>
    </div>
  </div>
</nav>

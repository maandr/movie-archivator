<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Movie Archivator</title>

    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,500,300,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{$BaseUrl}libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$BaseUrl}libs/bootstrap/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="{$BaseUrl}assets/css/main.css">

    <base href="{$BaseUrl}">
  </head>
<body>
  <!-- Navigation -->
  <nav>Navigation</nav>
  <!-- End Navigation -->

  <div id="content_wrapper">

    <!-- Content -->
    <div id="content" class="container">

      <div id="notifications">
        {foreach from=$Errors item=Error}
          <p class="error">{$Error}</p>
        {/foreach}

        {foreach from=$Warnings item=Warning}
          <p class="warning">{$Warning}</p>
        {/foreach}

        {foreach from=$Infos item=Info}
          <p class="info">{$Info}</p>
        {/foreach}
      </div>

      {block name=content}{/block}
    </div>
    <!-- End Content -->

    <!-- Footer -->
    <footer class="footer">
      {if $DebugMode}
        <strong>Request Information</strong>:<br />
        BaseUrl: {$BaseUrl}<br />
        RequestUrl: {$RequestUrl}
      {/if}
    </footer>
    <!-- End Footer -->

    </div>

    <script src="{$BaseUrl}libs/jquery/dist/jquery.min.js"></script>
    <script src="{$BaseUrl}libs/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>

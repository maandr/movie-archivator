<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Site Administation</title>
        
        <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,500,300,600,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{$BaseUrl}libs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{$BaseUrl}assets/css/login.css">
        
        <base href="{$BaseUrl}">
    </head>
    
    <body>
    
	    <div class="container">
	    
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
	    
			<form method="post" action="{$BaseUrl}login/send" class="form-signin">
				<label>Username</label>
				<input type="text" name="username" value="{$username}" placeholder="Username" required autofocus />
				<label>Password</label>
				<input type="password" name="password" placeholder="Password" requried />
				
				<input type="submit" name="submit" value="Login" class="btn btn-primary btn-block" />
			</form>
			
		</div>
		
        <script src="{$BaseUrl}libs/jquery/dist/jquery.min.js"></script>
        <script src="{$BaseUrl}libs/bootstrap/dist/js/bootstrap.min.js"></script>

    </body>
</html>
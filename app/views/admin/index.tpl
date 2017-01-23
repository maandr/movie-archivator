<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Administation</title>
        
        <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,500,300,600,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{$BaseUrl}libs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{$BaseUrl}assets/css/default.css">
        
        <base href="{$BaseUrl}">
    </head>
    <body>
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-md-2" id="side-menu">
    			<!-- start: side menu -->
					<div class="dropdown">
					    <a data-target="" href="" data-toggle="dropdown" class="dropdown-toggle icon-menu collection-inverse">Meine Sammlung <b class="caret"></b></a>
					    <ul class="dropdown-menu">
					    	<li><a href="movies/search">Suche</a></li>
				            <li><a href="filme">Meine Filme</a></li>
				            <li><a href="filme/watch-list/">Meine Watchlist</a></li>
					    </ul>   
					</div>
					<div class="dropdown">
					    <a data-target="" href="" data-toggle="dropdown" class="dropdown-toggle icon-menu filter-inverse">Filter <b class="caret"></b></a>
					    <ul class="dropdown-menu">
		                    <li><a href="filme/jahr/{$CurrentYear}">Jahr</a></li>
		                    <li><a href="filme/oscar-nominated/">Oscars Filme</a></li>
		                    <li><a href="filme/oscar-winners/">Oscar Gewinner</a></li>
		                    <li><a href="filme/tags/">Tags</a></li>
					    </ul>   
					</div>
					<div class="dropdown">
					    <a data-target="" href="" data-toggle="dropdown" class="dropdown-toggle icon-menu list-inverse">Genres <b class="caret"></b></a>
					    <ul class="dropdown-menu">
				            <li><a href="filme/genre/drama" class="icon-menu drama-inverse">Drama</a></li>
		                    <li><a href="filme/genre/biography" class="icon-menu biography-inverse">Biography</a></li>
		                    <li><a href="filme/genre/thriller" class="icon-menu thriller-inverse">Thriller</a></li>
		                    <li><a href="filme/genre/crime" class="icon-menu crime-inverse">Crime</a></li>
		                    <li><a href="filme/genre/sci-fi" class="icon-menu sci-fi-inverse">Sci-Fi</a></li>
		                    <li><a href="filme/genre/comedy" class="icon-menu comedy-inverse">Comedy</a></li>
		                    <li><a href="filme/genre/mystery" class="icon-menu mystery-inverse">Mystery</a></li>
		                    <li><a href="filme/genre/horror" class="icon-menu horror-inverse">Horror</a></li>
		                    <li><a href="filme/genre/fantasy" class="icon-menu fantasy-inverse">Fantasy</a></li>
		                    <li><a href="filme/genre/romance" class="icon-menu romance-inverse">Romance</a></li>
		                    <li><a href="filme/genre/war" class="icon-menu war-inverse">War</a></li>
		                    <li><a href="filme/genre/action" class="icon-menu action-inverse">Action</a></li>
		                    <li><a href="filme/genre/adventure" class="icon-menu adventure-inverse">Adventure</a></li>
		                    <li><a href="filme/genre/animation" class="icon-menu animation-inverse">Animation</a></li>
		                    <li><a href="filme/genre/music" class="icon-menu music-inverse">Music</a></li>
		                    <li><a href="filme/genre/western" class="icon-menu western-inverse">Western</a></li>
		                    <li><a href="filme/genre/history" class="icon-menu history-inverse">History</a></li>
		                    <li><a href="filme/genre/space" class="icon-menu space-inverse">Space</a></li>
					    </ul>   
					</div>
					<div class="dropdown">
					    <a data-target="" href="" data-toggle="dropdown" class="dropdown-toggle icon-menu top-list-inverse">Top Lists <b class="caret"></b></a>
					    <ul class="dropdown-menu">
				            <li><a href="filme/top/10">Top 10</a></li>
				            <li><a href="filme/top/100">Top 100</a></li>
				            <li><a href="filme/top/10/drama" class="icon-menu drama-inverse">Top 10 Drama</a></li>
				            <li><a href="filme/top/10/biography" class="icon-menu biography-inverse">Top 10 Biography</a></li>
				            <li><a href="filme/top/10/thriller" class="icon-menu thriller-inverse">Top 10 Thriller</a></li>
				            <li><a href="filme/top/10/crime" class="icon-menu crime-inverse">Top 10 Crime</a></li>
		                    <li><a href="filme/top/10/sci-fi" class="icon-menu sci-fi-inverse">Top 10 Sci-Fi</a></li>
		                    <li><a href="filme/top/10/comedy" class="icon-menu comedy-inverse">Top 10 Comedy</a></li>
		                    <li><a href="filme/top/10/mystery" class="icon-menu mystery-inverse">Top 10 Mystery</a></li>
		                    <li><a href="filme/top/10/horror" class="icon-menu horror-inverse">Top 10 Horror</a></li>
		                    <li><a href="filme/top/10/fantasy" class="icon-menu fantasy-inverse">Top 10 Fantasy</a></li>
		                    <li><a href="filme/top/10/romance" class="icon-menu romance-inverse">Top 10 Romance</a></li>
		                    <li><a href="filme/top/10/war" class="icon-menu war-inverse">Top 10 War</a></li>
		                    <li><a href="filme/top/10/action" class="icon-menu action-inverse">Top 10 Action</a></li>
		                    <li><a href="filme/top/10/adventure" class="icon-menu adventure-inverse">Top 10 Adventure</a></li>
		                    <li><a href="filme/top/10/animation" class="icon-menu animation-inverse">Top 10 Animation</a></li>
		                    <li><a href="filme/top/10/sport" class="icon-menu sport-inverse">Top 10 Sport</a></li>
		                    <li><a href="filme/top/10/music" class="icon-menu music-inverse">Top 10 Music</a></li>
		                    <li><a href="filme/top/10/western" class="icon-menu western-inverse">Top 10 Western</a></li>
		                    <li><a href="filme/top/10/history" class="icon-menu history-inverse">Top 10 History</a></li>
		                    <li><a href="filme/top/10/space" class="icon-menu space-inverse">Top 10 Space</a></li>
					    </ul>   
					</div>
					<div class="dropdown">
					    <a data-target="" href="" data-toggle="dropdown" class="dropdown-toggle icon-menu flop-list-inverse">Flop Lists <b class="caret"></b></a>
					    <ul class="dropdown-menu">
				            <li><a href="filme/flop/10">Flop 10</a></li>
				            <li><a href="filme/flop/10/drama" class="icon-menu drama-inverse">Flop 10 Drama</a></li>
				            <li><a href="filme/flop/10/biography" class="icon-menu biography-inverse">Flop 10 Biography</a></li>
				            <li><a href="filme/flop/10/thriller" class="icon-menu thriller-inverse">Flop 10 Thriller</a></li>
				            <li><a href="filme/flop/10/crime" class="icon-menu crime-inverse">Flop 10 Crime</a></li>
		                    <li><a href="filme/flop/10/sci-fi" class="icon-menu sci-fi-inverse">Flop 10 Sci-Fi</a></li>
		                    <li><a href="filme/flop/10/comedy" class="icon-menu comedy-inverse">Flop 10 Comedy</a></li>
		                    <li><a href="filme/flop/10/mystery" class="icon-menu mystery-inverse">Flop 10 Mystery</a></li>
		                    <li><a href="filme/flop/10/horror" class="icon-menu horror-inverse">Flop 10 Horror</a></li>
		                    <li><a href="filme/flop/10/fantasy" class="icon-menu fantasy-inverse">Flop 10 Fantasy</a></li>
		                    <li><a href="filme/flop/10/romance" class="icon-menu romance-inverse">Flop 10 Romance</a></li>
		                    <li><a href="filme/flop/10/war" class="icon-menu war-inverse">Flop 10 War</a></li>
		                    <li><a href="filme/flop/10/action" class="icon-menu action-inverse">Flop 10 Action</a></li>
		                    <li><a href="filme/flop/10/adventure" class="icon-menu adventure-inverse">Flop 10 Adventure</a></li>
		                    <li><a href="filme/flop/10/animation" class="icon-menu animation-inverse">Flop 10 Animation</a></li>
		                    <li><a href="filme/flop/10/sport" class="icon-menu sport-inverse">Flop 10 Sport</a></li>
		                    <li><a href="filme/flop/10/music" class="icon-menu music-inverse">Flop 10 Music</a></li>
		                    <li><a href="filme/flop/10/western" class="icon-menu western-inverse">Flop 10 Western</a></li>
		                    <li><a href="filme/flop/10/history" class="icon-menu history-inverse">Flop 10 History</a></li>
		                    <li><a href="filme/flop/10/space" class="icon-menu space-inverse">Flop 10 Space</a></li>
					    </ul>   
					</div>
					
					<div class="dropdown">
					    <a data-target="" href="" data-toggle="dropdown" class="dropdown-toggle icon-menu statistics-inverse">Statistik <b class="caret"></b></a>
					    <ul class="dropdown-menu">
				            <li><a href="filme/statistics-regisseur">Regisseure</a></li>
		                    <li><a href="filme/statistics-darsteller">Darsteller</a></li>
		                    <li><a href="filme/statistics-genre">Genres</a></li>
		                    <li><a href="filme/statistics-jahr">Jahr</a></li>
		                    <li><a href="filme/statistics-land">Land</a></li>
					    </ul>
					</div>
					<div class="dropdown"><a href="logout" class="icon-menu logout-inverse">Logout</a></div>
    			<!-- end: side menu -->
    			</div>
    			<div class="col-md-10" id="main-content">
    			
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
    			<!-- start: content -->
    			{block name=context_menu}{/block}
    			{block name=content}{/block}
    			<!-- end: content -->
    			</div>
    		</div>
    	</div>
        
        <script src="{$BaseUrl}libs/jquery/dist/jquery.min.js"></script>
        <script src="{$BaseUrl}libs/bootstrap/dist/js/bootstrap.min.js"></script>

    </body>
</html>
 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.2/custom/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>

        <title>SIA: Useful Quotes</title>
        <meta name="keywords" content="free english spanish mandarin cheneese french italian german russian real conversation partner learn spoken english speak speaking write writing skill enjoy language exchange partner grammar school slang exercises lessons on skype via icq vocabulary expansion dialogs study pronunciation spoken native speakers every taste different preparation exam ket pet fce cae cfe toefl IELTS BEC TOEIC EFL ESL">
        <meta name="description" content=" Free practice, enjoyable conversations, speaking, writing in a lot of languages (English, Spanish, Mandarin, Russian, German, French, Italian etc.) online via Skype or/and ICQ. Start improving your speaking, writing, listening, reading skills as soon as you start to talk.">
    </head>
    <body>
        <nav class="navbar navbar-default">
    	    <div class="container-fluid">
      	        <div class="navbar-header brand-name">
                    <a class="navbar-brand" href="."><strong>S</strong>ay <strong>I</strong>t <strong>A</strong>gain</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
      	        </div>
                <div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="quotes.php">Quotes</a></li>
						<li><a href="tips.html">Tips</a></li>
						<li role="presentation" class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
								English <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="sites.html">English resources</a></li>
								<li><a href="symphony.html">Sympony in Slang</a></li>	      
							</ul>
						</li>
					</ul>
                    <div  class="navbar-text navbar-right start-button">
                            <a href="buzz/" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
              	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
					<div class="panel panel-primary">
						<div class="panel-heading text-center">
							<h2 class="text-center">Useful quotes for language learners</h2>
						</div>
						<div class="panel-body">
							<?php
								$f = fopen("txt/quotes.txt", "r");
								$i=0;
								while (!feof($f)) {
									$quote = fgetcsv($f, 512, '%');

									$rev = ($i%2 == 1) ? " class=\"blockquote-reverse\"" : "";
									echo "<div class=\"row\"><div class=\"col-xs-12\"><blockquote$rev>";
									echo $quote[0] . "<footer>" . $quote[1];
									echo "</footer></blockquote></div></div>";
									$i++;
								}
								fclose($f);
							?>
						</div>
					</div>
                </div>
            </div>
        </div>
    </body>
</html>

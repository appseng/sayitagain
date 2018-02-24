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
        <meta name="description" content="Useful quotes for language learners">
    </head>
    <body>
        <?php
            $file = __FILE__;
            include_once 'inc/menu.php';
        ?>
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

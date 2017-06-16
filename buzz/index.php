 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/headjs/1.0.3/head.load.min.js"></script>

    <script>
        head.load([
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.4/custom/bootstrap.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css',
        'style.css',
        'script.js']);
    </script>
    
    <title>Find People for Language Practice</title>    
    <meta name="keywords" content="free english spanish mandarin cheneese french italian german russian real conversation partner learn spoken english speak speaking write writing skill enjoy language exchange partner grammar school slang exercises lessons on skype via icq vocabulary expansion dialogs study pronunciation spoken native speakers every taste different preparation exam ket pet fce cae cfe toefl IELTS BEC TOEIC EFL ESL">
    <meta name="description" content=" Free practice, enjoyable conversations, speaking, writing in a lot of languages (English, Spanish, Mandarin, Russian, German, French, Italian etc.) online via Skype or/and ICQ. Start improving your speaking, writing, listening, reading skills as soon as you start to talk.">
  </head>
  <body>
  <!--facebook sharer-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  <!-- begin google-analytics -->
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62332331-1', 'auto');
  ga('send', 'pageview');
  </script>
  <!-- end google-analytics -->
  
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="conteiner-fluid">
      <div class="navbar-header brand-name">
        <a class="navbar-brand" href="../."><b>S</b>ay <b>I</b>t <b>A</b>gain</a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
        </button>
      </div>  
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="../quotes.php">Quotes</a></li>
          <li><a href="../tips.html">Tips</a></li>
          <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
              English <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="../sites.html">English resources</a></li>
              <li><a href="../symphony.html">Sympony in Slang</a></li>           
            </ul>
          </li>
        </ul>
        <div class="navbar-text navbar-right start-button">
            <div style="margin-right:25px" class="fb-share-button" data-href="http://sayitagain.zz.vc/buzz/" data-layout="icon_link"></div>
        </div>
      </div>
    </div>
  </nav>
  <br />
  <br />
  <br />
    <!-- advertisement -->
    <div class="text-center">
        <!-- advertisement BEGIN-->
        <!-- advertisement END-->
    </div>
    
    <br />
    <div class="conteiner-fluid">
      <div class="panel panel-success">
        <div>
	  <form class="form-inline" id="input-form">
            <div class="header-info text-center">
                <span class="mark h3">Some info about you</span>
            </div>
	    <div class="row row-first">
	      <div class="form-group col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1">
		 <div class="input-group">
		  <input type="text" class="form-control" name="nick" id="nick" placeholder="Nick name" required>
		  <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
		</div>
	      </div>
	      <div class="form-group col-sm-2 col-sm-offset-1 col-xs-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1">
		<?php
		  include 'select_age.inc';
		?>
	      </div>
	      <div class="form-group col-sm-4 col-sm-offset-1 col-xs-4 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
		<div class="input-group">
		  <?php
		    include 'getcountries.php';
		  ?>
		  <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
		</div>
	      </div>
	    </div>
	    <div class="row row-middle">
	      <div class="form-group col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1">
		<div class="input-group">
		  <input type="text" class="form-control" name="skype" id="skype" placeholder="Skype">
		  <span class="input-group-addon info"><span class="glyphicon glyphicon-asterisk"></span></span>
		</div>
	      </div>
	      <div class="form-group col-sm-2 col-sm-offset-1 col-xs-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1">
		<?php
		  include 'select_sex.inc';
		?>
	      </div>
	      <div class="form-group col-sm-4 col-sm-offset-1 col-xs-4 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
		  <?php
		    include 'select_language.inc';
		  ?>
	      </div>
	    </div>
	    <div class="row row-middle">
	      <div class="form-group col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1">
		<div class="input-group">
		  <input type="text" class="form-control" name="icq" id="icq" placeholder="ICQ number">
		  <span class="input-group-addon info"><span class="glyphicon glyphicon-asterisk"></span></span>
		</div>
	      </div>
	      <div class="form-group col-sm-2 col-sm-offset-1 col-xs-3 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1">
		<?php
		  include 'select_goal.inc';
		?>
	      </div>
	      <div class="form-group col-sm-4 col-sm-offset-1 col-xs-4 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
		<?php
		  include 'select_level.inc';
		?>
	      </div>
	    </div>
	    <div class="row text-center row-last">
		<button type=button class="btn btn-success"  id="submit">
		  <span class="glyphicon glyphicon-user"></span> Add and/or Refresh</button>
            </div>
	  </form>
      </div>
    </div>  
    <br />
      <br />
      <br />
      <div class="panel-1">
	<div class="row">
	  <div id="learners" class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
	    <!--?php
	      include 'getquote.php';
	    ?-->
	  </div>
	</div>
      </div>
      <br />
      <br />
      <br />
      </div>
      <div class="text-center">

      </div>
      <br />
      <div class="center">
	<span><kbd>Copyright © 2015</kbd> | <code><a href="privacy.html">Privacy policy</a></code> | <abbr title="Say It Again!"><code><a href="/">sayitagain.zz.vc &amp; sayitagain.pw</a></code></abbr> | <code><a href="mailto:sayitagain666@gmail.com">contacts</a></code></span>
      </div>
      <br />
      <div class="text-center">
	<!-- advertisement BEGIN-->
	<!-- advertisement END-->
      </div>
    </body>
</html>
